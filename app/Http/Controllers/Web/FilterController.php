<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Experience;
use App\Models\Property;
use App\Models\Type;
use Illuminate\Http\Request;
use Meta;

class FilterController extends Controller
{
    public function sale()
    {
        $title = env('APP_NAME').' :: Quero Comprar';
        $route = route('web.sale');
        $description = 'Compre o imóvel dos seus sonhos na melhor e mais completa imobiliária de Espirito Santo!';
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

        $properties = Property::sale()->available()->orderBy('created_at', 'desc')->paginate(12);

        $type = 'sale';

        return view('web.filter.index', compact('properties', 'type'));
    }

    public function rent()
    {
        $title = env('APP_NAME').' :: Quero Alugar';
        $route = route('web.rent');
        $description = 'Alugue o imóvel dos seus sonhos na melhor e mais completa imobiliária de Espirito Santo!';
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

        $properties = Property::rent()->available()->orderBy('created_at', 'desc')->paginate(12);

        $type = 'rent';

        return view('web.filter.index', compact('properties', 'type'));
    }

    public function experience(Request $request)
    {
        $experiences = Experience::get()->pluck('slug', 'id')->toArray();

        $ids = [];

        foreach ($experiences as $key => $value) {
            if ($value == strtolower($request->slug)) {
                $ids[] = $key;
            }
        }

        $experience = Experience::whereIn('id', $ids)->first();

        $title = env('APP_NAME').' :: Experiência';
        $route = route('web.rent');
        $description = 'Viva a experiência de encontrar o imóvel dos seus sonhos na melhor e mais completa imobiliária de Espirito Santo!';
        /** Meta */
        Meta::title($title);
        Meta::set('description', $description);
        Meta::set('og:type', 'article');
        Meta::set('og:site_name', $title);
        Meta::set('og:locale', app()->getLocale());
        Meta::set('og:url', $route);
        Meta::set('twitter:url', $route);
        Meta::set('robots', 'index,follow');
        Meta::set('image', asset($experience->cover) ?? asset('img/share.webp'));
        Meta::set('canonical', $route);

        $properties = Property::available()->whereIn('experience_id', $ids)->orderBy('created_at', 'desc')->paginate(12);

        $type = null;

        return view('web.filter.index', compact('properties', 'type'));
    }

    /** Filter  */
    public function categories(Request $request)
    {
        switch ($request->goal) {
            case 'Venda':
                $properties = Property::sale()->available()->with('category')->get();
                break;
            case 'Locação':
                $properties = Property::rent()->available()->with('category')->get();
                break;
            default:
                $properties = Property::available()->with('category')->pluck();
                break;
        }

        $ids = array_unique((($properties->pluck('category'))->pluck('id'))->toArray());

        $categories = Category::whereIn('id', $ids)->orderBy('name')->pluck('name')->unique();

        return response()->json($categories);
    }

    public function types(Request $request)
    {
        switch ($request->goal) {
            case 'Venda':
                $properties = Property::sale()->available()->with('type')->get();
                break;
            case 'Locação':
                $properties = Property::rent()->available()->with('type')->get();
                break;
            default:
                $properties = Property::available()->with('type')->pluck();
                break;
        }

        $ids = array_unique((($properties->pluck('type'))->pluck('id'))->toArray());

        if ($request->category) {
            $category = Category::where('name', $request->category)->first();

            $types = Type::where('category_id', $category->id)
                ->whereIn('id', $ids)->orderBy('name')->pluck('name')->unique();
        } else {
            $types = Type::whereIn('id', $ids)->orderBy('name')->pluck('name')->unique();
        }

        return response()->json($types);
    }

    public function cities(Request $request)
    {
        $type = Type::where('name', $request->type)->first();

        switch ($request->goal) {
            case 'Venda':
                $properties = Property::sale()->available()->where('type_id', $type->id)->get();
                break;
            case 'Locação':
                $properties = Property::rent()->available()->where('type_id', $type->id)->get();
                break;
            default:
                $properties = Property::available()->where('type_id', $type->id)->get();
                break;
        }

        $cities = array_unique(($properties->pluck('city'))->toArray());

        return response()->json($cities);
    }

    public function bedrooms(Request $request)
    {
        $type = Type::where('name', $request->type)->first();

        switch ($request->goal) {
            case 'Venda':
                $properties = Property::sale()->available()
                    ->where('type_id', $type->id)
                    ->where('city', $request->city)
                    ->orderBy('bedrooms')
                    ->get();
                break;
            case 'Locação':
                $properties = Property::rent()->available()
                    ->where('type_id', $type->id)
                    ->where('city', $request->city)
                    ->orderBy('bedrooms')
                    ->get();
                break;
            default:
                $properties = Property::available()
                    ->where('type_id', $type->id)
                    ->where('city', $request->city)
                    ->orderBy('bedrooms')
                    ->get();
                break;
        }

        $bedrooms = array_unique(($properties->pluck('bedrooms'))->toArray());

        return response()->json($bedrooms);
    }

    public function suites(Request $request)
    {
        $type = Type::where('name', $request->type)->first();

        switch ($request->goal) {
            case 'Venda':
                $properties = Property::sale()->available()
                    ->where('type_id', $type->id)
                    ->where('city', $request->city)
                    ->where('bedrooms', $request->bedroom)
                    ->orderBy('suites')
                    ->get();
                break;
            case 'Locação':
                $properties = Property::rent()->available()
                    ->where('type_id', $type->id)
                    ->where('city', $request->city)
                    ->where('bedrooms', $request->bedroom)
                    ->orderBy('suites')
                    ->get();
                break;
            default:
                $properties = Property::available()
                    ->where('type_id', $type->id)
                    ->where('city', $request->city)
                    ->where('bedrooms', $request->bedroom)
                    ->orderBy('suites')
                    ->get();
                break;
        }

        $suites = array_unique(($properties->pluck('suites'))->toArray());

        return response()->json($suites);
    }

    public function bathrooms(Request $request)
    {
        $type = Type::where('name', $request->type)->first();

        switch ($request->goal) {
            case 'Venda':
                $properties = Property::sale()->available()
                    ->where('type_id', $type->id)
                    ->where('city', $request->city)
                    ->where('bedrooms', $request->bedroom)
                    ->where('suites', $request->suite)
                    ->orderBy('bathrooms')
                    ->get();
                break;
            case 'Locação':
                $properties = Property::rent()->available()
                    ->where('type_id', $type->id)
                    ->where('city', $request->city)
                    ->where('suites', $request->suite)
                    ->orderBy('bathrooms')
                    ->get();
                break;
            default:
                $properties = Property::available()
                    ->where('type_id', $type->id)
                    ->where('city', $request->city)
                    ->where('suites', $request->suite)
                    ->orderBy('bathrooms')
                    ->get();
                break;
        }

        $bathrooms = array_unique(($properties->pluck('bathrooms'))->toArray());

        return response()->json($bathrooms);
    }

    public function garages(Request $request)
    {
        $type = Type::where('name', $request->type)->first();

        switch ($request->goal) {
            case 'Venda':
                $properties = Property::sale()->available()
                    ->where('type_id', $type->id)
                    ->where('city', $request->city)
                    ->where('bedrooms', $request->bedroom)
                    ->where('suites', $request->suite)
                    ->where('bathrooms', $request->bathroom)
                    ->get();
                break;
            case 'Locação':
                $properties = Property::rent()->available()
                    ->where('type_id', $type->id)
                    ->where('city', $request->city)
                    ->where('suites', $request->suite)
                    ->where('bathrooms', $request->bathroom)
                    ->get();
                break;
            default:
                $properties = Property::available()
                    ->where('type_id', $type->id)
                    ->where('city', $request->city)
                    ->where('suites', $request->suite)
                    ->where('bathrooms', $request->bathroom)
                    ->get();
                break;
        }

        $garages = [];
        foreach ($properties as $property) {
            $garages[] = $property->garage + $property->garage_covered;
        }

        sort($garages);

        return response()->json(array_unique($garages));
    }

    public function basePrice(Request $request)
    {
        $type = Type::where('name', $request->type)->first();

        switch ($request->goal) {
            case 'Venda':
                $properties = Property::sale()->available()
                    ->where('type_id', $type->id)
                    ->where('city', $request->city)
                    ->where('bedrooms', $request->bedroom)
                    ->where('suites', $request->suite)
                    ->where('bathrooms', $request->bathroom)
                    ->orderBy('sale_price')
                    ->get();
                break;
            case 'Locação':
                $properties = Property::rent()->available()
                    ->where('type_id', $type->id)
                    ->where('city', $request->city)
                    ->where('suites', $request->suite)
                    ->where('bathrooms', $request->bathroom)
                    ->orderBy('rent_price')
                    ->get();
                break;
            default:
                $properties = Property::available()
                    ->where('type_id', $type->id)
                    ->where('city', $request->city)
                    ->where('suites', $request->suite)
                    ->where('bathrooms', $request->bathroom)
                    ->orderBy('sale_price')
                    ->get();
                break;
        }

        $base_price = [];
        foreach ($properties as $property) {
            if (($property->garage + $property->garage_covered) == $request->garage) {
                if ($request->goal == 'Venda') {
                    $base_price[] = $property->sale_price;
                } else {
                    $base_price[] = $property->rent_price;
                }
            }
        }

        return response()->json(array_unique($base_price));
    }

    public function limitPrice(Request $request)
    {
        $type = Type::where('name', $request->type)->first();

        $basePrice = str_replace(',', '.', str_replace('.', '', str_replace('R$ ', '', $request->base_price)));

        switch ($request->goal) {
            case 'Venda':
                $properties = Property::sale()->available()
                    ->where('type_id', $type->id)
                    ->where('city', $request->city)
                    ->where('bedrooms', $request->bedroom)
                    ->where('suites', $request->suite)
                    ->where('bathrooms', $request->bathroom)
                    ->where('sale_price', '>=', $basePrice)
                    ->orderBy('sale_price')
                    ->get();
                break;
            case 'Locação':
                $properties = Property::rent()->available()
                    ->where('type_id', $type->id)
                    ->where('city', $request->city)
                    ->where('suites', $request->suite)
                    ->where('bathrooms', $request->bathroom)
                    ->where('rent_price', '>=', $basePrice)
                    ->orderBy('rent_price')
                    ->get();
                break;
            default:
                $properties = Property::available()
                    ->where('type_id', $type->id)
                    ->where('city', $request->city)
                    ->where('suites', $request->suite)
                    ->where('bathrooms', $request->bathroom)
                    ->where('sale_price', '>=', $basePrice)
                    ->orderBy('sale_price')
                    ->get();
                break;
        }

        $limit_price = [];
        foreach ($properties as $property) {
            if (($property->garage + $property->garage_covered) == $request->garage) {
                if ($request->goal == 'Venda') {
                    $limit_price[] = $property->sale_price;
                } else {
                    $limit_price[] = $property->rent_price;
                }
            }
        }

        return response()->json(array_unique($limit_price));
    }

    public function filter(Request $request)
    {
        $type = Type::where('name', $request->type)->first();

        $basePrice = str_replace(',', '.', str_replace('.', '', str_replace('R$ ', '', $request->base_price)));
        $limitPrice = str_replace(',', '.', str_replace('.', '', str_replace('R$ ', '', $request->limit_price)));

        switch ($request->goal) {
            case 'Venda':
                $properties = Property::sale()->available()->where(
                    function ($query) use ($request, $type, $basePrice, $limitPrice) {
                        if ($request->type) {
                            $query->where('type_id', $type->id);
                        }
                        if ($request->city) {
                            $query->where('city', $request->city);
                        }
                        if ($request->bedroom) {
                            $query->where('bedrooms', $request->bedroom);
                        }
                        if ($request->suites) {
                            $query->where('suites', $request->suites);
                        }
                        if ($request->bathrooms) {
                            $query->where('bathrooms', $request->bathrooms);
                        }
                        if ($request->base_price) {
                            $query->where('sale_price', '>=', $basePrice);
                        }
                        if ($request->limit_price) {
                            $query->where('sale_price', '<=', $limitPrice);
                        }
                    }
                )->paginate(12);

                $type = 'sale';

                return view('web.filter.index', compact('properties', 'type'));
                break;

            case 'Locação':
                $properties = Property::rent()->available()->where(
                    function ($query) use ($request, $type, $basePrice, $limitPrice) {
                        if ($request->type) {
                            $query->where('type_id', $type->id);
                        }
                        if ($request->city) {
                            $query->where('city', $request->city);
                        }
                        if ($request->bedroom) {
                            $query->where('bedrooms', $request->bedroom);
                        }
                        if ($request->suites) {
                            $query->where('suites', $request->suites);
                        }
                        if ($request->bathrooms) {
                            $query->where('bathrooms', $request->bathrooms);
                        }
                        if ($request->base_price) {
                            $query->where('rent_price', '>=', $basePrice);
                        }
                        if ($request->limit_price) {
                            $query->where('rent_price', '<=', $limitPrice);
                        }
                    }
                )->paginate(12);

                $type = 'rent';

                return view('web.filter.index', compact('properties', 'type'));
                break;
            default:
                $properties = Property::sale()->available()->where(
                    function ($query) use ($request, $type, $basePrice, $limitPrice) {
                        if ($request->type) {
                            $query->where('type_id', $type->id);
                        }
                        if ($request->city) {
                            $query->where('city', $request->city);
                        }
                        if ($request->bedroom) {
                            $query->where('bedrooms', $request->bedroom);
                        }
                        if ($request->suites) {
                            $query->where('suites', $request->suites);
                        }
                        if ($request->bathrooms) {
                            $query->where('bathrooms', $request->bathrooms);
                        }
                        if ($request->base_price) {
                            $query->where('sale_price', '>=', $basePrice);
                        }
                        if ($request->limit_price) {
                            $query->where('sale_price', '<=', $limitPrice);
                        }
                    }
                )->paginate(12);

                $type = 'sale';

                return view('web.filter.index', compact('properties', 'type'));
                break;
        }
    }
}
