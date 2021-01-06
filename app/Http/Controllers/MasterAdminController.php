<?php

namespace App\Http\Controllers;

// use App\Master;
// use App\User;
use Illuminate\Http\Request;

class MasterAdminController extends Controller
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

        return view('masters.masters', ['masters' => User::whereNotNull('master_id')->get()->sortByDesc('master.created_at')]);
        // return response()->file(storage_path('/app/private/' . $master->master->image));
    }

    public function show(int $id)
    {

        return view('masters.mastershow', ['master' => Master::find($id), 'masterPoints' => Master::find($id)->masterPoint]);
    }

    public function updateStatus(Request  $request)
    {

        // User::find($request->id)->master->update(['confirmation' => $request->confirmation]);
        Master::find($request->id)->update([
            'status' => !$request->status
            ]);

        return  !$request->status;
    }
}
