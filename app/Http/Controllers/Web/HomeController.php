<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use App\Models\Property;
use Meta;

class HomeController extends Controller
{
    public function index()
    {

        $title = env('APP_NAME');
        $route = route('web.home');
        $description = env('APP_DESCRIPTION');
        /** Meta */
        Meta::title($title);
        Meta::set('description', $description);
        Meta::set('og:type', 'article');
        Meta::set('og:site_name', $title);
        Meta::set('og:locale', app()->getLocale());
        Meta::set('og:url', $route);
        Meta::set('twitter:url', $route);
        Meta::set('robots', 'index,follow');
        Meta::set('image', asset('img/share.webp'));
        Meta::set('canonical', $route);

        $propertiesForSale = Property::sale()->available()->orderBy('created_at', 'desc')->limit(12)->get();
        $propertiesForRent = Property::rent()->available()->orderBy('created_at', 'desc')->limit(12)->get();

        $experiences = Experience::all();

        return view('web.home.index', compact('propertiesForSale', 'propertiesForRent', 'experiences'));
    }
}
