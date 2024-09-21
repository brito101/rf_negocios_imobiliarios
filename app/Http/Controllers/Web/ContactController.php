<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\ContactRequest;
use App\Models\Client;
use App\Models\Property;
use App\Models\Step;
use Illuminate\Support\Str;
use Meta;

class ContactController extends Controller
{
    public function index()
    {

        $title = env('APP_NAME').' :: Contato';
        $route = route('web.contact');
        $description = 'Quer conversar com um corretor exclusivo e ter o atendimento diferenciado em busca do seu imóvel dos sonhos? '
            .'Entre em contato com a nossa equipe!';
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

        return view('web.contact.index');
    }

    public function send(ContactRequest $request)
    {
        $property = Property::find($request->property_id);

        $data = $request->all();
        if ($property) {
            $data['user_id'] = $property->user_id;
            $data['agency_id'] = $property->agency_id;
            $data['property_interest'] = $property->id;
        }

        $data['contact_message'] = Str::limit($request->message, 1000);

        $data['step_id'] = Step::orderBy('sequence', 'asc')->first()->id;
        $client = Client::create($data);

        if ($client->save()) {
            return view('web.contact.success');
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Erro ao enviar!');
        }
    }
}
