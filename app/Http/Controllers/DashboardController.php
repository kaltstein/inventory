<?php

namespace App\Http\Controllers;

use App\Models\vc;
use Illuminate\Http\Request;
use App\Models\Software;
use App\Models\UserSoftware;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('dashboard.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\vc  $vc
     * @return \Illuminate\Http\Response
     */
    public function show(vc $vc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\vc  $vc
     * @return \Illuminate\Http\Response
     */
    public function edit(vc $vc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\vc  $vc
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, vc $vc)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\vc  $vc
     * @return \Illuminate\Http\Response
     */
    public function destroy(vc $vc)
    {
        //
    }

    public function list(Request $request)
    {





        if ($request->ajax()) {
            $query = UserSoftware::select(
                UserSoftware::raw(
                    'SUM(DISTINCT software.stocks) as total_stocks 
                ,COUNT(user_softwares.user_id) as total_users
                ,SUM(DISTINCT software.stocks) - COUNT(user_softwares.user_id) as spare
                ,software.name '
                )
            )
                ->leftJoin('software', 'user_softwares.software_id', 'software.id')->groupBy('name');


            return datatables()->eloquent($query)



                ->toJson();
        }
    }
}
