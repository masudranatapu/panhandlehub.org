<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Setting;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Modules\Plan\Entities\Plan;
use App\Http\Controllers\Controller;
use PDF;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_if(!userCan('order.view'), 403);

        $data['transactions'] = Transaction::with('customer')
            ->when(request()->has('customer') && request('customer') != null, function ($q) use ($request) {
                $q->where('user_id', request('customer'));
            })
            ->when(request()->has('plan') && request('plan') != null, function ($q) use ($request) {
                $q->where('plan_id', request('plan'));
            })
            ->when(request()->has('provider') && request('provider') != null, function ($q) use ($request) {
                $q->where('payment_provider', request('provider'));
            })
            ->when(request()->has('sort_by') && request('sort_by') != null, function ($q) use ($request) {
                if (request('sort_by') == 'latest') {
                    $q->latest();
                } else {
                    $q->oldest();
                }
            })
            ->latest()
            ->paginate(20)
            ->withQueryString();



        $data['customers'] = User::latest()->get(['id', 'name', 'email']);
        $data['plans'] = Plan::latest()->get();

        return view('admin.order.index', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        abort_if(!userCan('order.view'), 403);

        $transaction->load('plan', 'customer');

        return view('admin.order.show', compact('transaction'));
    }

    /**
     * Download invoice as pdf or print.
     *
     * @param  int  $transaction
     * @return \Illuminate\Http\Response
     */
    public function downloadTransactionInvoice(Transaction $transaction)
    {
        $data['transaction'] = $transaction->load('plan', 'customer');
        $data['setting'] = setting('logo_image');

        $pdf = PDF::loadView('admin.order.invoice', $data)->setPaper('a4', 'portrait')->setWarnings(false);

        return $pdf->download("invoice_" . $transaction->order_id . ".pdf");
    }
}
