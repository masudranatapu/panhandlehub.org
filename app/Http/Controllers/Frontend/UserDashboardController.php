<?php

namespace App\Http\Controllers\Frontend;

use File;
use Carbon\Carbon;
use App\Models\User;
use App\Models\AdType;
use App\Models\Country;
use App\Mail\RegisterMail;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Modules\Ad\Entities\Ad;
use Illuminate\Http\Request;
use Modules\Ad\Entities\AdGallery;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Modules\Wishlist\Entities\Wishlist;

class UserDashboardController extends Controller
{
    //
    public function profile()
    {
        $user = Auth::user();
        $ads = Ad::active()->where('user_id', Auth::id())->paginate(15);
        return view('frontend.user.profile', compact('user', 'ads'));
    }



    public function drafts()
    {
        $user = Auth::user();
        $ads = Ad::pending()->where('user_id', $user->id)->paginate(15);
        return view('frontend.user.drafts', compact('user', 'ads'));
    }

    public function favourite()
    {
        $user = Auth::user();
        $wishlist = Wishlist::where('user_id', Auth::user()->id)->paginate(15);

        return view('frontend.user.search', compact('user', 'wishlist'));
    }
    public function favouriteDelete($id)
    {
        $wishlist = Wishlist::find($id);
        $wishlist->delete();
        return back()->with('message', 'Item successfully removed from favorite.');
    }

    public function transaction()
    {
        $transactions = Transaction::with('ad')->where('user_id', Auth::id())->orderBy('id', 'desc')->paginate(10);

        return view('frontend.user.transaction', compact('transactions'));
    }

    public function transactionDetails($id)
    {

        $transactionDetails = Transaction::find($id);
        return view('frontend.user.transaction-details', compact('transactionDetails'));
    }

    public function setting()
    {
        $user = Auth::user();
        return view('frontend.user.setting', compact('user'));
    }

    public function editPost($slug)
    {

        $ad = Ad::where('slug', $slug)->first();
        $country = Country::with('cities')->where('iso', strtoupper(getCountryCode()))->first();

        return view('frontend.user.post-edit', compact('ad', 'country'));
    }

    public function updatePost(Request $request, $slug)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'job_title' => 'required_if:ad_type,job-offered',
            'laundry' => 'required_if:ad_type,housing-offered',
            'parking' => 'required_if:ad_type,housing-offered',
            'bedrooms' => 'required_if:ad_type,housing-offered',
            'bathrooms' => 'required_if:ad_type,housing-offered',
            'language' => 'required_if:ad_type,for-sale-by-owner',
            'email' => 'required|email',
            'availability' => 'required_if:ad_type,job-wanted',
            'education' => 'required_if:ad_type,job-wanted',
            'services' => 'required_if:ad_type,event-class',
            'employment_type' => 'required_if:ad_type,job-offered',
            'availability' => 'required_if:ad_type,job-wanted',
        ]);

        if ($request->event_start_date) {
            $event_start_date = Carbon::parse($request->event_start_date);
            $event_end_date = Carbon::parse($request->event_start_date)->addDays($request->event_duration);
        }


        if (!Auth::check()) {
            $user = User::where('email', $request->email)->first();
            if (!$user) {
                // $status = 'pending';
                $random_token = Str::random(40);
                $email = explode('@', $request->email);
                $username = $email[0] . '_' . random_int(1111, 9999);
                $user = User::create([
                    'email' => $request->email,
                    'username' => $username,
                    'token' => $random_token,
                    'created_at' => Carbon::now(),
                ]);

                $details = [
                    'subject' => 'Welcome to ' . ' ' . config('app.name'),
                    'greeting' => 'Hi you just post on' . ' ' . config('app.name'),
                    'body' => 'You have to verify your email to publish this post.',
                    'email' => 'Your email is : ' . $request->email,
                    'thanks' => 'Thank you and stay with ' . ' ' . config('app.name'),
                    'actionText' => 'Click Here to Verify',
                    'actionURL' => route('user.verify', $random_token),
                    'site_url' => route('frontend.index'),
                    'site_name' => config('app.name'),
                    'copyright' => ' © ' . ' ' . Carbon::now()->format('Y') . config('app.name') . ' ' . 'All rights reserved.',
                ];

                Mail::to($request->email)->send(new RegisterMail($details));
            }
        }
        // dd($request->all());
        $country = strtoupper(getCountryCode());

        $ad =  Ad::where('slug', $slug)->first();
        // dd($ad);
        $ad->ad_type_id         = $request->ad_type_id;
        $ad->category_id        = $request->category_id;
        $ad->subcategory_id     = $request->subcategory_id;
        $ad->country            = $country;
        $ad->title              = $request->title;
        $ad->user_id            = Auth::user()->id ?? $user->id;
        // $ad->status             = $status ?? 'active';
        $ad->city               = $request->city;
        $ad->postcode           = $request->postcode;
        $ad->description        = $request->description;
        $ad->employment_type    = $request->employment_type;
        $ad->services           = $request->services;
        $ad->job_title          = $request->job_title;
        $ad->price              = $request->price;
        $ad->company_name       = $request->company_name;
        $ad->email              = $request->email;
        $ad->email_privacy      = $request->email_privacy;
        $ad->show_phone         = $request->show_phone ?? 0;
        $ad->phone_call         = $request->phone_call ?? 0;
        $ad->phone_text         = $request->phone_text ?? 0;
        $ad->phone              = $request->phone;
        $ad->phone_2            = $request->phone_2;
        $ad->contact_name       = $request->contact_name;
        // job wanted
        $ad->availability       = $request->availability;
        $ad->education          = $request->education;
        $ad->is_license         = $request->is_license ?? 0;
        $ad->license_info       = $request->license_info;
        $ad->other_contact      = $request->other_contact ?? 0;
        // House offered
        $ad->sqft               = $request->sqft;
        $ad->houssing_type      = $request->houssing_type;
        $ad->laundry            = $request->laundry;
        $ad->parking            = $request->parking;
        $ad->bedrooms           = $request->bedrooms;
        $ad->bathrooms          = $request->bathrooms;
        $ad->available_on       = $request->available_on;
        // for-sale-by-owner
        $ad->conditions         = $request->condition;
        $ad->model_name         = $request->model_name;
        $ad->manufacturer       = $request->manufacturer;
        $ad->dimension          = $request->dimension;
        $ad->language           = $request->language;
        // event class
        $ad->event_start_date   = $event_start_date ?? null;
        $ad->event_end_date     = $event_end_date ?? null;
        $ad->event_duration     = $request->event_duration . ' days';
        $ad->venue              = $request->venue;
        // House wanted
        $ad->broker_fee                 = $request->broker_fee ?? 0;
        $ad->broker_fee_detailed        = $request->broker_fee_detailed;
        $ad->application_fee            = $request->application_fee ?? 0;
        $ad->application_fee_detailed   = $request->application_fee_detailed;

        if ($request->file('thumbnail')) {
            if (File::exists($ad->thumbnail)) {
                File::delete($ad->thumbnail);
            }
            $thumbnail = uploadResizedImage($request->thumbnail, 'addss_image', 850, 650, false);
            $ad->thumbnail = $thumbnail;
        }

        // dd($ad);
        $ad->save();



        $images = $request->file('images');
        $old = $request->old;
        $gallery = AdGallery::where('ad_id', $ad->id)->get();
        if ($old) {
            foreach ($gallery as $value) {
                if (!in_array($value->id, $old)) {
                    $value->delete();
                }
            };
        } else {
            foreach ($gallery as $value) {
                $value->delete();
            };
        }
        if ($images) {
            foreach ($images as $key => $image) {
                if ($key == 0 && $image && $image->isValid()) {

                    $url = uploadResizedImage($image, 'addss_image', 850, 650, false);
                    $ad->update(['thumbnail' => $url]);
                }

                if ($image && $image->isValid()) {

                    $url = uploadResizedImage($image, 'adds_multiple', 850, 650, false);
                    $ad->galleries()->create(['ad_id' => $ad->id, 'image' => $url]);
                }
            }
        }
        // if ($ad->status == 'active') {
            flashSuccess('Post Updated successfully');
            return redirect()->route('user.profile')->with('message', 'Post Updated successfully');
        // }
    }
    public function deletePost($id)
    {
        $ad = Ad::find($id);
        $ad->delete();
        flashSuccess('Post deleted successfully');
        return back()->with('message', 'Post deleted successfully');
    }
    public function statusUpdate($id, $status)
    {
        $ad = Ad::find($id);
        $ad->update([
            'status' => $status
        ]);
        if ($status == 'active') {
            return back()->with('message', 'Post published successfully');
        } else {
            return back()->with('error', 'Post unpublished successfully');
        }
    }
    public function passwordReset()
    {
        $user = User::find(Auth::id());

        $rememberToken = Str::random(40);

        $update = $user->update([
            'token' => $rememberToken,
        ]);

        $details = [
            'subject' => 'Password reset for ' . ' ' . config('app.name'),
            'greeting' => 'Hi, Your password reset link successfully sent.',
            'body' => 'Your requested password sent successfully done from ' . ' ' . config('app.name') . '. ' . 'Now You can change your password from given the link.',
            'email' => 'Your email is : ' . $user->email,
            'thanks' => 'Thank you and stay with ' . ' ' . config('app.name'),
            'actionText' => 'Change Password',
            'actionURL' => route('user.password.reset.store', $rememberToken),
            'site_url' => route('frontend.index'),
            'site_name' => config('app.name'),
            'copyright' => ' © ' . ' ' . Carbon::now()->format('Y') . config('app.name') . ' ' . 'All rights reserved.',
        ];
        Mail::to($user->email)->send(new RegisterMail($details));

        return back()->with('message', 'A password reset mail sent to your email address.');
    }

    public function userLogOut()
    {
        auth()->guard('user')->logout();

        return redirect()->route('frontend.index');
    }

    public function userMessage()
    {
        return view('frontend.user.message');
    }

    public function userReview()
    {

        return view('frontend.user.review');
    }
}
