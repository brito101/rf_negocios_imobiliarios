<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\User;
use App\Models\Views\Agency as ViewsAgency;
use App\Models\Views\Client as ViewsClient;
use App\Models\Views\Property as ViewsProperty;
use App\Models\Views\User as ViewsUser;
use App\Models\Views\Visit;
use App\Models\Views\VisitYesterday;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $administrators = 0;
        $brokers = 0;
        if (Auth::user()->hasRole('Programador|Administrador')) {
            $administrators = ViewsUser::where('type', 'Administrador')->count();
            $brokers = ViewsUser::where('type', 'Corretor')->count();
            $agencies = ViewsAgency::count();
            $propertiesModel = ViewsProperty::all();
            $properties = $propertiesModel->count();
            $lastProperties = Property::latest()->limit(6)->get();
            $clients = ViewsClient::latest()->limit(10)->get();
        } else {
            $agencies_id = Auth::user()->brokers->pluck('agency_id');
            $agencies = ViewsAgency::whereIn('id', $agencies_id)->count();
            $propertiesModel = ViewsProperty::whereIn('agency_id', $agencies)->count();
            $properties = $propertiesModel->count();
            $lastProperties = Property::whereIn('id', $agencies)->latest()->limit(6)->get();
            $clients = ViewsClient::whereIn('agency_id', Auth::user()->brokers->pluck('agency_id'))->latest()->limit(10)->get();
        }

        $propertiesType = $propertiesModel->groupBy('type')->toArray();
        $propertiesTypeChart = ['label' => [], 'data' => []];
        foreach ($propertiesType as $key => $value) {
            $propertiesTypeChart['label'][] = Str::of($key)->words(1);
            $propertiesTypeChart['data'][] = count($value);
        }

        $propertiesCategory = $propertiesModel->groupBy('category')->toArray();
        $propertiesCategoryChart = ['label' => [], 'data' => []];
        foreach ($propertiesCategory as $key => $value) {
            $propertiesCategoryChart['label'][] = Str::of($key)->words(2);
            $propertiesCategoryChart['data'][] = count($value);
        }

        $propertiesExperience = $propertiesModel->groupBy('experience')->toArray();
        $propertiesExperienceChart = ['label' => [], 'data' => []];
        foreach ($propertiesExperience as $key => $value) {
            $propertiesExperienceChart['label'][] = Str::of($key)->words(2);
            $propertiesExperienceChart['data'][] = count($value);
        }

        $visits = Visit::where('url', '!=', route('admin.home.chart'))
            ->where('url', 'NOT LIKE', '%columns%')
            ->where('url', 'NOT LIKE', '%storage%')
            ->where('url', 'NOT LIKE', '%admin%')
            ->where('url', 'NOT LIKE', '%offline%')
            ->where('url', 'NOT LIKE', '%manifest.json%')
            ->where('url', 'NOT LIKE', '%.png%')
            ->get();

        if ($request->ajax()) {
            return Datatables::of($visits)
                ->addColumn('time', function ($row) {
                    return date(('H:i:s'), strtotime($row->created_at));
                })
                ->addIndexColumn()
                ->rawColumns(['time'])
                ->make(true);
        }

        /** Statistics */
        $statistics = $this->accessStatistics();
        $onlineUsers = $statistics['onlineUsers'];
        $percent = $statistics['percent'];
        $access = $statistics['access'];
        $chart = $statistics['chart'];

        return view('admin.home.index', compact(
            'administrators',
            'brokers',
            'agencies',
            'clients',
            'properties',
            'lastProperties',
            'onlineUsers',
            'percent',
            'access',
            'chart',
            'propertiesTypeChart',
            'propertiesCategoryChart',
            'propertiesExperienceChart',
        ));
    }

    public function chart()
    {
        /** Statistics */
        $statistics = $this->accessStatistics();
        $onlineUsers = $statistics['onlineUsers'];
        $percent = $statistics['percent'];
        $access = $statistics['access'];
        $chart = $statistics['chart'];

        return response()->json([
            'onlineUsers' => $onlineUsers,
            'access' => $access,
            'percent' => $percent,
            'chart' => $chart,
        ]);
    }

    private function accessStatistics()
    {
        $onlineUsers = User::online()->count();

        $accessToday = Visit::where('url', '!=', route('admin.home.chart'))
            ->where('url', 'NOT LIKE', '%columns%')
            ->where('url', 'NOT LIKE', '%storage%')
            ->where('url', 'NOT LIKE', '%admin%')
            ->where('url', 'NOT LIKE', '%offline%')
            ->where('url', 'NOT LIKE', '%manifest.json%')
            ->where('url', 'NOT LIKE', '%.png%')
            ->where('method', 'GET')
            ->get();
        $accessYesterday = VisitYesterday::where('url', '!=', route('admin.home.chart'))
            ->where('url', 'NOT LIKE', '%columns%')
            ->where('url', 'NOT LIKE', '%storage%')
            ->where('url', 'NOT LIKE', '%admin%')
            ->where('url', 'NOT LIKE', '%offline%')
            ->where('url', 'NOT LIKE', '%manifest.json%')
            ->where('url', 'NOT LIKE', '%.png%')
            ->where('method', 'GET')
            ->count();

        $totalDaily = $accessToday->count();

        $percent = 0;
        if ($accessYesterday > 0 && $totalDaily > 0) {
            $percent = number_format((($totalDaily - $accessYesterday) / $totalDaily * 100), 2, ',', '.');
        }

        /** Visitor Chart */
        $data = $accessToday->groupBy(function ($reg) {
            return date('H', strtotime($reg->created_at));
        });

        $dataList = [];
        foreach ($data as $key => $value) {
            $dataList[$key.'H'] = count($value);
        }

        $chart = new \stdClass;
        $chart->labels = (array_keys($dataList));
        $chart->dataset = (array_values($dataList));

        return [
            'onlineUsers' => $onlineUsers,
            'access' => $totalDaily,
            'percent' => $percent,
            'chart' => $chart,
        ];
    }
}
