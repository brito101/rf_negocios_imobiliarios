<?php

namespace App\Http\Controllers\Web;

use App\Helpers\Cookie;
use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;

class CookieController extends Controller
{
    public function index(Request $request)
    {
        $cookie = filter_var($request->cookie, 513);

        Cookie::set('cookieConsent', $cookie, (12 * 43200));  // 1 year

        if ($cookie == 'accept') {
            $json['gtmHead'] = view('web._partials.gtm-head')->render();
            $json['gtmBody'] = view('web._partials.gtm-body')->render();
        }

        $json['cookie'] = true;

        return \response()->json($json);
    }

    public function landingPage(Request $request)
    {
        $cookie = filter_var($request->cookie, 513);

        $property = Property::find($request->id);

        if ($cookie == 'accept') {
            Cookie::set('cookieConsent', $cookie, (12 * 43200));  // 1 year
            if ($property) {
                $json['gtmHead'] = $property->header_pixel ?? view('web._partials.gtm-head')->render();
                $json['gtmBody'] = $property->body_pixel ?? view('web._partials.gtm-body')->render();
            } else {
                $json['gtmHead'] = view('web._partials.gtm-head')->render();
                $json['gtmBody'] = view('web._partials.gtm-body')->render();
            }
        }

        $json['cookie'] = true;

        return \response()->json($json);
    }
}
