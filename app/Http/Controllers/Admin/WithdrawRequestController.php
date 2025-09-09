<?php

namespace App\Http\Controllers\Admin;

use App\Models\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class WithdrawRequestController extends Controller
{

    function index(): View
    {
        $withdraws = Withdraw::with('instructor')->paginate(12);
        return view('admin.withdraw-request.index', compact('withdraws'));
    }


    function show(Withdraw $withdraw): View
    {
        return view('admin.withdraw-request.show', compact('withdraw'));
    }


    function updateStatus(Request $request, Withdraw $withdraw): RedirectResponse|Response
    {
        if ($withdraw->status !== 'pending' )
        {
            notyf()->error("After updating status, you can't revert it.");
            //return response(["message" => "After updating status, you can\'t revert it."], 422);
            return redirect()->back();
        }
        elseif ($request->status === 'pending' && $withdraw->status === 'pending')
        {
            notyf()->warning("Pending is already set.");
            return redirect()->back();
        }
        else
        {
            $withdraw->instructor->wallet -= $withdraw->amount;
            $withdraw->instructor->save();
            $withdraw->status = $request->status;
            $withdraw->save();
            notyf()->success("Updating status successfully.");
            return redirect()->back();
        }


    }
}
