<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Ad\Entities\Ad;
use Modules\Review\Entities\Review;

class SellerDashboardController extends Controller
{
    public function sellerProfile(Request  $request, $username)
    {
        $seller = User::where('username', $username)->first();
        if ($seller) {
            $query = Ad::active()->where('user_id', $seller->id);
            $ads_count = $query->count();
            if ($request->has('sort') && $request->sort != null) {
                if ($request->sort == 'high_to_low') {
                    $query->orderBy('price', 'desc');
                }
                if ($request->sort == 'low_to_high') {
                    $query->orderBy('price', 'asc');
                }
                if ($request->sort == 'recent') {
                    $query->latest();
                }
            }
            $ads = $query->paginate(8);
            $reviews = Review::where('seller_id', $seller->id)->get();
            return view('frontend.seller_shop', compact('ads', 'ads_count', 'seller', 'reviews'));
        } else {
            return back()->with('error', 'something is wrong');
        }
    }

    public function storeReview(Request $request)
    {
        $user = Auth::user();
        $seller = User::find($request->seller_id);
        $old_data = Review::where('user_id', $user->id)->where('seller_id', $seller->id)->first();
        if ($old_data) {
            return back()->with('error', "You already reviewed this seller.");
        }
        $review = new Review();
        $review->stars = $request->star;
        $review->seller_id = $seller->id;
        $review->comment = $request->comment;
        $review->user_id =  $user->id;
        $review->created_at = now();
        $review->save();
        return back()->with('success', "Thanks for your review. It's submitted successfully.");
    }
}
