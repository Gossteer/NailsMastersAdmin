<?php

namespace App\Http\Controllers;

use App\Models\LoggerShow;
use App\Services\Logger\iLoggerConfig;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LoggerShowController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $logger = LoggerShow::orderByDesc('created_at')->with('user', 'nailsJobs')->paginate(30);

        $today_tour = Carbon::now();
        $carbon_statistik_add = Carbon::create($today_tour->format('Y'), 1, 1, 00, 0, 0);
        $carbon_statistik_sub = Carbon::create($today_tour->format('Y'), 1, 1, 00, 0, 0);

        for ($i=0; $i < 12; $i++) {
            $carbon_statistik_add->addMonth();
            $type_id_login[] = $logger->where('type_id', 1)->where('created_at', '>=',  date('Y-m-d H:i', strtotime($carbon_statistik_sub)))->where('created_at', '<=',  date('Y-m-d H:i', strtotime($carbon_statistik_add)))->count();
            $type_id_register[] = $logger->where('type_id', 2)->where('created_at', '>=',  date('Y-m-d H:i', strtotime($carbon_statistik_sub)))->where('created_at', '<=',  date('Y-m-d H:i', strtotime($carbon_statistik_add)))->count();
            $type_id_loadingnailsjobs[] = $logger->where('type_id', 3)->where('created_at', '>=',  date('Y-m-d H:i', strtotime($carbon_statistik_sub)))->where('created_at', '<=',  date('Y-m-d H:i', strtotime($carbon_statistik_add)))->count();
            $type_id_redirecttoinstagram[] = $logger->where('type_id', 4)->where('created_at', '>=',  date('Y-m-d H:i', strtotime($carbon_statistik_sub)))->where('created_at', '<=',  date('Y-m-d H:i', strtotime($carbon_statistik_add)))->count();
            $type_id_addfavoritenailsjobs[] = $logger->where('type_id', 5)->where('created_at', '>=',  date('Y-m-d H:i', strtotime($carbon_statistik_sub)))->where('created_at', '<=',  date('Y-m-d H:i', strtotime($carbon_statistik_add)))->count();
            $carbon_statistik_sub->addMonth();
        }

        // dd($type_id_login, $logger);

        return view('pages.loggers.loggers', ['loggers' => $logger, 'canvas' => [
            json_encode($type_id_login,JSON_NUMERIC_CHECK),
            json_encode($type_id_register,JSON_NUMERIC_CHECK),
            json_encode($type_id_loadingnailsjobs,JSON_NUMERIC_CHECK),
            json_encode($type_id_redirecttoinstagram,JSON_NUMERIC_CHECK),
            json_encode($type_id_addfavoritenailsjobs,JSON_NUMERIC_CHECK),
        ]]);
    }
}
