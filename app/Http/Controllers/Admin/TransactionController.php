<?php

namespace App\Http\Controllers\Admin;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    public function index(){
        $transactions = Transaction::with('ad')->orderBy('id','desc')->paginate(10);
        return view('admin.transaction.index',compact('transactions'));
    }

    public function view($id)
    {
        $transaction = Transaction::find($id);
        return view('admin.transaction.view',compact('transaction'));
    }

    public function delete($id)
    {

        DB::beginTransaction();
        try {
            $transaction = Transaction::find($id);
            $transaction->delete();
        } catch (\Exception $e) {
            DB::rollback();
            flashSuccess('Data not Deleted');
            return redirect()->route('transaction.index');
        }
        DB::commit();
        flashSuccess('Data Deleted Successfully');
        return redirect()->route('transaction.index');
    }
}
