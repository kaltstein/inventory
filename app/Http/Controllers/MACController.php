<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\MAC;

class MACController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::orderBy('name')->get();
        return view('mac.mac', compact(['users']));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        error_log($request->user_id);
        $request->validate([
            'asset_no' => 'required',
        ]);

        MAC::create([
            'user_id' => $request->user_id,
            'asset_no' => $request->asset_no,
            'FA_control_no' => $request->FA_control_no,
            'specs' => $request->specs,
            'branch' => $request->branch,
            'warranty_check' => $request->warranty_check,
            'warranty' => $request->warranty,
            'supplier' => $request->supplier,
            'system_sn' => $request->system_sn,
            'status' => $request->status,
            'date_released' => $request->date_released,
        ]);


        return redirect()->back()->with('success', $request->asset_no . ' has been added');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $users = User::all();

        $mac_details = MAC::findOrFail($request->id);
        return view('mac.details', compact(['mac_details', 'users']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        return MAC::findOrFail($request->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'edit_asset_no' => 'required',
        ]);

        $mac = MAC::findOrFail($request->edit_id);



        $mac->user_id = $request->edit_user_id;
        $mac->asset_no = $request->edit_asset_no;
        $mac->FA_control_no = $request->edit_FA_control_no;
        $mac->specs = $request->edit_specs;
        $mac->branch = $request->edit_branch;
        $mac->warranty_check = $request->edit_warranty_check;
        $mac->warranty = $request->edit_warranty;
        $mac->supplier = $request->edit_supplier;
        $mac->system_sn = $request->edit_system_sn;
        $mac->status = $request->edit_status;
        $mac->date_released = $request->edit_date_released;
        $mac->save();

        return redirect()->back()->with('success', $request->edit_asset_no . ' has been edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function list(Request $request)
    {


        if ($request->ajax()) {
            $query = MAC::select('*')->with('current_user');
            return datatables()->eloquent($query)



                ->toJson();
        }
    }
}
