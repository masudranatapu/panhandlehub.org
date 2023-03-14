<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\User;
use App\Models\AdType;
use App\Models\Country;
use App\Mail\RegisterMail;
use Illuminate\Support\Str;
use Modules\Ad\Entities\Ad;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Modules\Category\Entities\Category;
use Modules\Category\Entities\SubCategory;

class AdPostController extends Controller
{
    //
    public function create($post_type = null, $subcategory = null)
    {

        if (Auth::check()) {
            if ($post_type == null) {
                $add_types = AdType::orderBy('id', 'asc')->get();
                return view('frontend.post.step_one', compact('add_types'));
            } else {

                if ($subcategory) {

                    $ad_type = AdType::where('slug', $post_type)->first();
                    $subCategory = SubCategory::where('slug', $subcategory)->first();
                    $category = Category::where('id', $subCategory->category_id)->first();
                    $country = Country::with('cities')->where('iso', strtoupper(getCountryCode()))->first();
                    return view('frontend.post.step_four', compact('ad_type', 'category', 'subCategory', 'country'));


                    // if ($subcategory) {
                    // } else {
                    //     $ad_type = AdType::where('slug', $post_type)->first();
                    //     $category = Category::where('slug', $category)->first();
                    //     $subCategory = SubCategory::where('category_id', $category->id)->orderBy('id', 'desc')->get();
                    //     return view('frontend.post.step_three', compact('subCategory', 'category', 'ad_type'));
                    // }

                } else {
                    $ad_type = AdType::where('slug', $post_type)->first();
                    $subCategory = SubCategory::where('ad_type_id', $ad_type->id)->orderBy('id', 'desc')->get();
                    return view('frontend.post.step_two', compact('subCategory', 'ad_type'));
                }
            }
        } else {
            return redirect()->route('signin');
        }
    }

    public function store(Request $request): RedirectResponse
    {
        // dd($request->all());

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
                $status = 'pending';
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
        $slug = Str::slug($request->title);
        $old_slug = Ad::where('slug', $slug)->first();
        $country = strtoupper(getCountryCode());

        $ad = new Ad();
        $ad->ad_type_id         = $request->ad_type_id;
        $ad->category_id        = $request->category_id;
        $ad->subcategory_id     = $request->subcategory_id;
        $ad->country            = $country;
        $ad->title              = $request->title;
        $ad->slug               = $slug;
        $ad->user_id            = Auth::user()->id ?? $user->id;
        $ad->status             = $status ?? 'active';
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

        // dd($ad);
        $ad->save();

        if ($old_slug) {
            $slug = $slug . '_' . $ad->id;
            $ad->update(['slug' => $slug]);
        }

        $images = $request->file('images');
        if ($images) {
            foreach ($images as $key => $image) {
                if ($key == 0 && $image && $image->isValid()) {

                    $url = uploadResizedImage($image, 'addss_image', 500, 450, false);
                    $ad->update(['thumbnail' => $url]);
                }

                if ($image && $image->isValid()) {

                    $url = uploadResizedImage($image, 'adds_multiple', 500, 450, false);
                    $ad->galleries()->create(['ad_id' => $ad->id, 'image' => $url]);
                }
            }
        }
        $is_pay = $ad->ad_type->is_paid;
        if ($is_pay == 1) {
            $status = 'pending';
            $ad->status = $status;
            $ad->is_payable = 1;
            $ad->save();
            if (Auth::check()) {
                return redirect()->route('frontend.payment.post', $ad->id);
            }
        }
        if ($ad->status == 'active') {
            flashSuccess('Post created successfully');
            return redirect()->route('user.setting')->with('message', 'Post created successfully');
        } else {
            flashSuccess('Your Post is in drafted. Please verify email to publish this post.');
            return redirect()->route('signin')->with('message', 'Your Post is in drafted. Please verify email to publish this post.');
        }
    }
}
