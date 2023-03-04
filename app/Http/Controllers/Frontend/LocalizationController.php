<?php

namespace App\Http\Controllers\Frontend;

use App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Google\Service\Dfareporting\Country;

class LocalizationController extends Controller
{

    public function setLang(Request $request){

        app()->setLocale($request->language);
        session()->put('locale', $request->language);

        return redirect()->back()->with('success', 'language change successfully');
    }

}
