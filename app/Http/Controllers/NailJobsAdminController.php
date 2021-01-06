<?php

namespace App\Http\Controllers;

// use App\NailsJobs;
use Illuminate\Http\Request;

class NailJobsAdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('cafw');
        $this->middleware('auth');
    }



    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {


        // $response = Http::post('http://nailsmasterstest.com.xsph.ru/api/login', [
        //     'headers' => [
        //         'Accept' => 'application/json',
        //     ],
        //     'email' => 'admin@admin',
        //     'password' => '123'
        // ]);

        // //dd('Bearer '.$response['token'], $response['token_type']);

        // $response1 = Http::withToken($response['token'])->get('http://nailsmasterstest.com.xsph.ru/api/place');

        // dd(json_decode($response1, true), $response1->json());
        // $master = User::find(1);
        // dd(NailsJobs::all()->sortByDesc('created_at'));
        return view('nailjobs.nailjobs', ['nailjobs' => NailsJobs::all()->sortByDesc('created_at')]);
        // return response()->file(storage_path('/app/private/' . $master->master->image));
    }

    public function updateStatus(Request  $request)
    {
        $status = ($request->status == 1 or $request->status == 3) ? 0 : 1;
        // User::find($request->id)->master->update(['confirmation' => $request->confirmation]);
        NailsJobs::find($request->id)->update([
            'status' => $status
            ]);

        return  $status;
    }
}
