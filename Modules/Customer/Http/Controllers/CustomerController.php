<?php

namespace Modules\Customer\Http\Controllers;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Claims\Custom;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use Modules\Customer\Http\Requests\CustomerCreateFormRequest;
use Modules\Customer\Http\Requests\CustomerUpdateFormRequest;

class CustomerController extends Controller
{
    /**
     * Display a listing of the customers.
     * @return Renderable
     */
    public function index()
    {
      

        $query = User::query();

        // keyword search
        if (request()->has('keyword') && request()->keyword != null) {
            $keyword = request('keyword');
            $query->where('name', "LIKE", "%$keyword%")
                ->orWhere('username', "LIKE", "%$keyword%")
                ->orWhere('email', "LIKE", "%$keyword%");
        }

        // filtering
        if (request()->has('filter_by') && request()->filter_by != null) {
            switch (request()->filter_by) {
                case 'verified':
                    $query->whereNotNull('email_verified_at');
                    break;
                case 'unverified':
                    $query->whereNull('email_verified_at');
                    break;
            }
        }

        $query->withCount('transactions');
        $customers = $query->paginate(10)
        ->withQueryString();

        return view('customer::index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('customer::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param CustomerCreateFormRequest $request
     * @return Renderable
     */
    public function store(CustomerCreateFormRequest $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $url = $request->image->move('uploads/customer', $request->image->hashName());
            $data['image'] = $url;
        }

        User::create($data);

        flashSuccess('Customer Created Successfully');
        return back();
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(User $customer)
    {
        $ads = $customer->ads->load('category:id,name,slug');
        $transactions = Transaction::where('user_id', $customer->id)->latest()->get();

        return view('customer::show', compact('customer', 'ads', 'transactions'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(User $customer)
    {
        return view('customer::edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     * @param CustomerUpdateFormRequest $request
     * @param Customer $customer
     * @return Renderable
     */
    public function update(CustomerUpdateFormRequest $request, User $customer)
    {
        $data = $request->all();
        if ($data['password'] != null) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $url = $request->image->move('uploads/customer', $request->image->hashName());
            $data['image'] = $url;
        }

        $customer->update($data);

        flashSuccess('Customer Updated Successfully');
        return redirect()->route('module.customer.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(User $customer)
    {
        if ($customer) {
            $customer->delete();
        }

        flashSuccess('Customer Deleted Successfully');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function emailVerify(Request $request)
    {
        $customer = User::where('username', $request->username)->firstOrFail();

        if ($customer->email_verified_at) {
            $customer->update(['email_verified_at' => null]);
        } else {
            $customer->update(['email_verified_at' => now()]);
        }

        if ($customer->email_verified_at) {
            return response()->json(['message' => 'Email Verified Successfully']);
        } else {
            return response()->json(['message' => 'Email Unverified Successfully']);
        }
    }

    public function ads(User $customer)
    {
        $ads = $customer->ads->load('category:id,name,slug', 'subcategory:id,name,slug', 'brand:id,name,slug');

        return view('customer::ads', compact('ads', 'customer'));
    }
}
