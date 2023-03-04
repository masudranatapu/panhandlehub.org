<?php

namespace App\Http\Controllers\Admin;

use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class FaqController extends Controller
{
    public function index()
    {

        $faqs = Faq::orderBy('id', 'desc')->paginate(20);
        return view('admin.faq.index', compact('faqs'));
    }

    public function create()
    {
        return view('admin.faq.create');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'question'  => 'required',
            'answer'  => 'required',
        ]);
        DB::beginTransaction();
        try {

            $faq = new Faq();
            $faq->question = $request->question;
            $faq->answer = $request->answer;
            $faq->save();
        } catch (\Exception $e) {
            DB::rollback();
            flashSuccess('Data not Created');
            return redirect()->route('faq.index');
        }
        DB::commit();
        flashSuccess('Data Created Successfully');
        return redirect()->route('faq.index');
    }

    public function edit($id)
    {
        $faq = Faq::find($id);
        return view('admin.faq.edit', compact('faq'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'question'  => 'required',
            'answer'  => 'required',
        ]);
        DB::beginTransaction();
        try {
            $faq = Faq::find($id);
            $faq->question = $request->question;
            $faq->answer = $request->answer;
            $faq->save();
        } catch (\Exception $e) {
            DB::rollback();
            flashSuccess('Data not Updated');
            return redirect()->route('faq.index');
        }
        DB::commit();
        flashSuccess('Data Updated Successfully');
        return redirect()->route('faq.index');
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $faq = Faq::find($id);
            $faq->delete();
        } catch (\Exception $e) {
            DB::rollback();
            flashSuccess('Data not Deleted');
            return redirect()->route('faq.index');
        }
        DB::commit();
        flashSuccess('Data Deleted Successfully');
        return redirect()->route('faq.index');
    }
}
