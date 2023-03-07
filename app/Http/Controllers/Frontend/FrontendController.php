<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Faq;
use App\Models\Seo;
use App\Models\AdType;
use App\Models\Contact;
use App\Models\AdGallery;
use App\Models\Transaction;
use Modules\Ad\Entities\Ad;
use function Sodium\compare;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Modules\Category\Entities\Category;
use Modules\Wishlist\Entities\Wishlist;
use Google\Service\Dfareporting\Country;
use Modules\Category\Entities\SubCategory;
use Modules\Language\Entities\Language;

class FrontendController extends Controller
{

    public function index()
    {

        $local_country = session()->get('local_country');
        $ads = Ad::orderBy('id', 'desc')->take(10);

        if ($local_country) {
            $ads->where('country', $local_country);
        }

        $ads = $ads->get();
        $languages = Language::orderBy('name', 'asc')->get();

        $countries =  DB::table('country')->orderBy('name', 'asc')->get();
        $ad_types   = AdType::orderBy('id', 'asc')->get();
        $categories = Category::whereHas('subcategories')->orderBy('id', 'desc')->get();
        $top_categoreis = Category::orderBy('id', 'desc')->get();
        $coutry_iso = strtoupper(getCountryCode());

        $country = DB::table('country')->where('iso', $coutry_iso)->first();

        $cities = DB::table('city')->where('country_id', $country->id)->get();
        $seo = Seo::where('page_slug', 'home')->first();
        $meta_title = $seo->contents->title;
        $meta_description = $seo->contents->description;
        $meta_keywords = $seo->contents->keywords;
        $meta_image = $seo->contents->image;

        return view('frontend.index', compact('ads', 'ad_types', 'countries', 'cities', 'languages','meta_title', 'meta_description', 'meta_image', 'meta_keywords', 'categories', 'top_categoreis'));
    }

    public function setCountry(Request $request)
    {
        session()->put('local_country', strtolower($request->country));
        return redirect()->back()->with('success', 'Coutry change successfully');
    }



    public function search(Request $request)
    {
//        dd($request->country);
        $query = Ad::active();
        $country = getCountryCode();
        $categories = Category::orderBy('id', 'asc')->get();
        $subcategories = [];
        if ($request->country) {
            $country = $request->country;
            $query->whereHas('countries', function ($q) use ($country) {
                $q->where('iso', $country);
            });
        }
        // if($request->ad_type) {
        //     $ad_type = $request->ad_type;
        //     $query->whereHas('ad_type', function ($q) use ($ad_type) {
        //         $q->where('slug', $ad_type);
        //     });
        // }
        // $ads = $query->get();
        // dd($ads);
        if ($request->category) {
            $category_slug = $request->category;
            $subcategories = SubCategory::whereHas('category', function ($q) use ($category_slug) {
                $q->where('slug', $category_slug);
            })->get();
            $query->whereHas('category', function ($q) use ($category_slug) {
                $q->where('slug', $category_slug);
            });
        }


        if ($request->subcategory) {
            $subcategory = $request->subcategory;
            $query->whereHas('subcategory', function ($q) use ($subcategory) {
                $q->where('slug', $subcategory);
            });
        }


        if ($request->city) {
            $query->where('city', $request->city);
        }


        if ($request->search && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        if ($request->post && $request->post != '') {
            $post = $request->post;
            if (in_array('title', $post)) {
                $query->whereNotNull('title');
            }
            if (in_array('image', $post)) {
                $query->whereNotNull('thumbnail');
            }
            if (in_array('today', $post)) {
                $today = Carbon::today();
                $query->whereDate('created_at', $today);
            }
        }
        if ($request->sort && $request->sort != '') {
            $sort = $request->sort;
            if ($sort == 'latest') {
                $query->latest();
            }
            if ($sort == 'oldest') {
                $query->oldest();
            }
            if ($sort == 'asc') {
                $query->orderBy('title', 'asc');
            }
            if ($sort == 'desc') {
                $query->orderBy('title', 'desc');
            }
        }
        if ($request->min_price && $request->min_price != '') {
            $query->whereNotNull('price')->where('price', '>', $request->min_price);
        }
        if ($request->max_price && $request->max_price != '') {
            $query->whereNotNull('price')->where('price', '<', $request->max_price);
        }
        if ($request->date && $request->date != '') {
            $date = Carbon::parse($request->date);
            $query->whereDate('event_start_date', $date);
        }

        $ads = $query->paginate(9);


        return view('frontend.shop', compact('ads', 'subcategories', 'categories'));
    }
    public function details($slug)
    {
        $ad_details = Ad::with('ad_type')->where('slug', $slug)->first();

        if($ad_details->status == 'active'){

        // dd($ad_details->ad_type->slug);
        $ad_galleies = AdGallery::where('ad_id', $ad_details->id)->get();
        $seo = Seo::where('page_slug', 'home')->first();
        $meta_title = $seo->contents->title;
        $meta_description = $seo->contents->description;
        $meta_keywords = $seo->contents->keywords;
        $meta_image = $seo->contents->image;

        return view('frontend.details', compact('ad_details', 'ad_galleies', 'meta_title', 'meta_description', 'meta_keywords', 'meta_image'));
        }else{
            return redirect()->route('frontend.index');
        }
    }

    public function wishlistCreate(Request $request)
    {
        $id = $request->id;
        $user = $request->user;
        $isExist = Wishlist::where(['ad_id' => $id, 'user_id' => $user])->first();
        if (!$isExist) {
            $wishlist = new Wishlist();
            $wishlist->user_id = $user;
            $wishlist->ad_id = $id;
            $wishlist->save();
            if ($request->ajax()) {
                return response()->json(['status' => 'success', 'message' => 'Wishlist added successfully']);
            }

            $notification = trans('user_validation.Wishlist added successfully');
            $notification = array('messege' => $notification, 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        } else {
            $isExist->delete();
            if ($request->ajax()) {
                return response()->json(['status' => 'failed', 'message' => 'Wishlist removed successfully']);
            }
            $notification = trans('user_validation.Item already exist');
            $notification = array('messege' => $notification, 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }
    }
    public function about()
    {
        $seo = Seo::where('page_slug', 'home')->first();
        $meta_title = $seo->contents->title;
        $meta_description = $seo->contents->description;
        $meta_keywords = $seo->contents->keywords;
        $meta_image = $seo->contents->image;
        return view('frontend.about', compact('meta_title', 'meta_description', 'meta_keywords', 'meta_image'));
    }

    public function termsCondition()
    {
        $seo = Seo::where('page_slug', 'home')->first();
        $meta_title = $seo->contents->title;
        $meta_description = $seo->contents->description;
        $meta_keywords = $seo->contents->keywords;
        $meta_image = $seo->contents->image;
        return view('frontend.terms_conditon', compact('meta_title', 'meta_description', 'meta_keywords', 'meta_image'));
    }

    public function privacyPolicy()
    {
        $seo = Seo::where('page_slug', 'home')->first();
        $meta_title = $seo->contents->title;
        $meta_description = $seo->contents->description;
        $meta_keywords = $seo->contents->keywords;
        $meta_image = $seo->contents->image;
        return view('frontend.privacy_policy', compact('meta_title', 'meta_description', 'meta_keywords', 'meta_image'));
    }

    public function faq()
    {

        $faqs = Faq::orderBy('id', 'asc')->get();
        $seo = Seo::where('page_slug', 'home')->first();
        $meta_title = $seo->contents->title;
        $meta_description = $seo->contents->description;
        $meta_keywords = $seo->contents->keywords;
        $meta_image = $seo->contents->image;
        return view('frontend.faq', compact('faqs', 'meta_title', 'meta_description', 'meta_keywords', 'meta_image'));
    }

    public function pricePlan()
    {
        return view('frontend.price_plan');
    }
    public function contact()
    {

        $seo = Seo::where('page_slug', 'home')->first();
        $meta_title = $seo->contents->title;
        $meta_description = $seo->contents->description;
        $meta_keywords = $seo->contents->keywords;
        $meta_image = $seo->contents->image;
        return view('frontend.contact', compact('seo', 'meta_title', 'meta_description', 'meta_keywords', 'meta_image'));
    }

    public function contactSub(Request $request)
    {
        $this->validate($request, [
            'name'  => 'required',
            'email'  => 'required',
            'phone' => 'required',
            'reason' => 'required',
            'message' => 'nullable'
        ]);

        DB::beginTransaction();
        try {
            $data = new Contact();
            $data->name = $request->name;
            $data->email = $request->email;
            $data->phone = $request->phone;
            $data->reason = $request->reason;
            $data->message = $request->message;
            $data->save();
        } catch (\Exception $e) {
            DB::rollback();
            flashSuccess('Your Request is Not Submitted!.');
            return redirect()->route('frontend.contact')->with('error', 'Your Request is Not Submitted!');
        }
        DB::commit();
        flashSuccess('Your Request is Submitted!.');
        return redirect()->route('frontend.contact')->with('message', 'Your Request is Submitted!');
    }

    public function postPayment($id)
    {
        $ad = Ad::find($id);
        return view('frontend.post.payment',compact('ad'));
    }

    public function paymentInvoice($id){
        $transaction = Transaction::find($id);
        return view('frontend.post.payment-invoice',compact('transaction'));
    }

    public function sellerShop(){
        return view('frontend.seller_shop');
    }



}
