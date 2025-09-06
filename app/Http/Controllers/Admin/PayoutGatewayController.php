<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PayoutGateway;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;

class PayoutGatewayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $gateways = PayoutGateway::all();
        return view('admin.course.payout-gateway.index', compact('gateways'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.course.payout-gateway.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        $gateway = new PayoutGateway();
        $gateway->name = $request->name;
        $gateway->status = $request->status;
        $gateway->save();

        notyf()->success('Payout Gateway created successfully.');

        return redirect()->route('admin.payout-gateway.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PayoutGateway $payout_gateway): View
    {
        return view('admin.course.payout-gateway.edit', compact('payout_gateway'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PayoutGateway $payout_gateway)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        $payout_gateway->name = $request->name;
        $payout_gateway->status = $request->status;
        $payout_gateway->save();

        notyf()->success('Payout Gateway updated successfully.');

        return redirect()->route('admin.payout-gateway.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PayoutGateway $payout_gateway): HttpResponse
    {
        try {
            $payout_gateway->delete();
            notyf()->info('Payout Gateway Deleted');
            return response(['message' => 'delete success']);

        }
        catch (\Throwable $e) {
            notyf()->error("Something went wrong.");
            return response(["message" => "something went wrong"], 500);
        }
    }
}
