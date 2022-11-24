<?php

namespace App\Http\Controllers;

use App\Models\Hardware;
use Illuminate\Http\Request;
use App\Models\User;

class HardwareController extends Controller
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

        // return Http::dd()->get('http://10.134.30.27/portal/public/user/list/api');

        $users = User::all();
        return view('hardware.hardware', compact(['users']));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $request->validate([
            'name' => 'required',
        ]);


        Hardware::create([
            'user_id' => $request->user_id,
            'name' => $request->name,
            'asset_no' => $request->asset_no,
            'brand' => $request->brand,
            'specs' => $request->specs,
            'supplier' => $request->supplier,
            'serial_no' => $request->serial_no,
            'service_tag' => $request->service_tag,
            'FA_control_no' => $request->FA_control_no,
            'date_released' => $request->date_released,
        ]);


        return redirect()->back()->with('success', $request->name . ' has been added');
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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        return Hardware::findOrFail($request->id);
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
            'edit_name' => 'required',
        ]);

        $hardware = Hardware::findOrFail($request->edit_id);

        if ($request->edit_user_id != '' and $request->edit_status == 'inactive') {
            return redirect()->back()->with('error', 'You cannot set device to inactive while being used. You must unassign the current user first.');
        }
        $hardware->asset_no = $request->edit_asset_no;
        $hardware->user_id = $request->edit_user_id;
        $hardware->name = $request->edit_name;
        $hardware->brand = $request->edit_brand;
        $hardware->specs = $request->edit_specs;
        $hardware->supplier = $request->edit_supplier;
        $hardware->serial_no = $request->edit_serial_no;
        $hardware->service_tag = $request->edit_service_tag;
        $hardware->FA_control_no = $request->edit_FA_control_no;
        $hardware->date_released = $request->edit_date_released;
        $hardware->status = $request->edit_status;
        $hardware->save();

        return redirect()->back()->with('success', $request->edit_name . ' has been edited');
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
            $query = Hardware::select('*')->with('current_user');
            return datatables()->eloquent($query)

                ->toJson();
        }
    }
}
