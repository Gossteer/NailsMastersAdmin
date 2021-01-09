<?php

namespace App\Http\Controllers;

// use App\Master;
// use App\User;


use App\Models\UserMaster;

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

        //$masters = //Master::all(); //Http::withToken(Auth::user()->token)->get(config('api.server_1.get.MasterIndex'))->json();


        return view('pages.masters.masters', ['masters' => UserMaster::whereNotNull('master_id')->get()->sortByDesc('master.created_at')]);
    }

    // public function show(int $id)
    // {

    //     return view('masters.mastershow', ['master' => Master::find($id), 'masterPoints' => Master::find($id)->masterPoint]);
    // }

    // public function updateStatus(Request  $request)
    // {

    //     // User::find($request->id)->master->update(['confirmation' => $request->confirmation]);
    //     Master::find($request->id)->update([
    //         'status' => !$request->status
    //         ]);

    //     return  !$request->status;
    // }
}
