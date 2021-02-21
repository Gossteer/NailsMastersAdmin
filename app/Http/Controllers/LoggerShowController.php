<?php

namespace App\Http\Controllers;

use App\Models\LoggerShow;
use App\Models\UserMaster;
use Carbon\Carbon;
use App\Services\Paginator\PaginateForCollection;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class LoggerShowController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $logger = LoggerShow::orderByDesc('created_at')->with('user', 'nailsJobs')->get();
        // $logger = new Collection();
        // $fullexperiences = UserMaster::with('master.masterPoint.nailsJobs', 'logger.nailsJobs', 'logger.user')->get();
        $fullexperiences = UserMaster::with('master.masterPoint.nailsJobs')->get();

        $fullexperiencearray['Masters'] = 0;
        $fullexperiencearray['Points'] = 0;
        $fullexperiencearray['Nails'] = 0;
        $fullexperiencearray['Users'] = $fullexperiences->count();

        foreach ($fullexperiences as $fullexperience) {
            // if ($fullexperience->logger->count()) {
            //     $logger = $logger->merge($fullexperience->logger->toBase());
            // }
            if ($fullexperience->master ?? false) {
                $fullexperiencearray['Points'] += $fullexperience->master->masterPoint->count();
                foreach ($fullexperience->master->masterPoint as $masterPoint) {
                    $fullexperiencearray['Nails']  += $masterPoint->nailsJobs->count();
                }
                $fullexperiencearray['Masters']++;
            }
        }

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

        return view('pages.loggers.loggers', ['loggers' => PaginateForCollection::paginate($logger, 30) , 'canvas' => [
            json_encode($type_id_login,JSON_NUMERIC_CHECK),
            json_encode($type_id_register,JSON_NUMERIC_CHECK),
            json_encode($type_id_loadingnailsjobs,JSON_NUMERIC_CHECK),
            json_encode($type_id_redirecttoinstagram,JSON_NUMERIC_CHECK),
            json_encode($type_id_addfavoritenailsjobs,JSON_NUMERIC_CHECK),
        ], 'fullexperiencearray' => $fullexperiencearray]);
    }


}
