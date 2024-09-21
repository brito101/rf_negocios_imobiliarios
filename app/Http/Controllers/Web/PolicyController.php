<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Meta;

class PolicyController extends Controller
{
    public function index()
    {

        $title = env('APP_NAME').' :: Política de Pivacidade';
        $route = route('web.policy');
        $description = 'Política de Privacidade da melhor plataforma web de Espirito Santo!';
        /** Meta */
        Meta::title($title);
        Meta::set('description', $description);
        Meta::set('og:type', 'article');
        Meta::set('og:site_name', $title);
        Meta::set('og:locale', app()->getLocale());
        Meta::set('og:url', $route);
        Meta::set('twitter:url', $route);
        Meta::set('robots', 'index,follow');
        Meta::set('image', asset('img/share.png'));
        Meta::set('canonical', $route);

        return view('web.policy.index');
    }
}
