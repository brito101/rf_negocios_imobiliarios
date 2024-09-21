<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;
use Meta;

class CampaignController extends Controller
{
    public function index(Request $request)
    {
        $property = Property::where('slug', $request->slug)->with('type', 'images')->first();

        if ($property) {
            $title = env('APP_NAME').' :: '.$property->title;
            $route = route('web.campaign', ['slug' => $property->slug]);
            $description = $property->headline ?? $property->title;
            /** Meta */
            Meta::title($title);
            Meta::set('description', $description);
            Meta::set('og:type', 'article');
            Meta::set('og:site_name', $title);
            Meta::set('og:locale', app()->getLocale());
            Meta::set('og:url', $route);
            Meta::set('twitter:url', $route);
            Meta::set('robots', 'index,follow');
            Meta::set('image', $property->cover ? url('storage/properties/'.$property->cover) : asset('img/share.webp'));
            Meta::set('canonical', $route);

            switch ($property->template) {
                case 'default':
                    return view('web.campaign.default', compact('property'));
                    break;

                default:
                    return view('web.campaign.default', compact('property'));
                    break;
            }
        } else {
            return abort(404);
        }
    }
}
