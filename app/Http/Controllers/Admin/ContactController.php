<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function index(){

        $users = Contact::orderBy('id','desc')->paginate(10);
        return view('admin.contact.index',compact('users'));
    }

    public function view($id){

        $contact = Contact::find($id);
        return view('admin.contact.view', compact('contact'));
    }

    public function delete($id){

        DB::beginTransaction();
        try {
            $city = Contact::find($id);
            $city->delete();
        } catch (\Exception $e) {
            DB::rollback();
            flashSuccess('Data not Deleted');
            return redirect()->route('contact.index');
        }
        DB::commit();
        flashSuccess('Data Deleted Successfully');
        return redirect()->route('contact.index');
    }
}
