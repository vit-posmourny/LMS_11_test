<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Withdraw;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class WithdrawController extends Controller
{

    function index(): View
    {
        return view('frontend.instructor-dashboard.withdraw.index');
    }


    function requestPayoutIndex() : View
    {
        $currentBallance = user()->wallet;
        $pendingBallance = Withdraw::where('instructor_id', user()->id)->where('status', 'pending')->sum('amount');
        $totalPayouts = Withdraw::where('instructor_id', user()->id)->where('status', 'approved')->sum('amount');
        return view('frontend.instructor-dashboard.withdraw.request-payout',
                compact('currentBallance', 'pendingBallance', 'totalPayouts'));
    }


    function requestPayout(Request $request): RedirectResponse
    {
        $request->validate([
            'amount' => 'required|numeric',
        ]);

        if (user()->wallet < $request->amount)
        {
            notyf()->error("Insufficient balance.");
            return redirect()->back();
        }

        if (Withdraw::where('instructor_id', user()->id)->where('status', 'pending')->exists())
        {
            notyf()->warning('Withdraw request already pending.');
            return redirect()->back();
        }

        $withdraw = new Withdraw();
        $withdraw->instructor_id = user()->id;
        $withdraw->amount = $request->amount;
        $withdraw->save();
        notyf()->info('Withdraw request send.');
        return redirect()->back();
    }
}
