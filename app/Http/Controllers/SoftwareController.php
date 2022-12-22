<?php

namespace App\Http\Controllers;

use App\Models\Software;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserSoftware;

class SoftwareController extends Controller
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
        return view('software.software', compact(['users']));
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


        Software::create([
            'name' => $request->name,
            'FA_control_no' => $request->FA_control_no,
            'stocks' => $request->stocks,
            'supplier' => $request->supplier,
            'contract_no' => $request->contract_no,
            'remarks' => $request->remarks,
            'expiry_date' => $request->expiry_date,
            'license_type' => $request->license_type,
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
    public function show(Request $request)
    {
        $users = User::orderBy('name')->get();

        $software_details = Software::findOrFail($request->id);
        return view('software.details', compact(['software_details', 'users']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        return Software::findOrFail($request->id);
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

        $software = Software::findOrFail($request->edit_id);



        $software->name = $request->edit_name;
        $software->FA_control_no = $request->edit_FA_control_no;
        $software->stocks = $request->edit_stocks;
        $software->supplier = $request->edit_supplier;
        $software->contract_no = $request->edit_contract_no;
        $software->remarks = $request->edit_remarks;
        $software->expiry_date = $request->edit_expiry_date;
        $software->license_type = $request->edit_license_type;



        $software->save();

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
            $query = Software::select('*');
            return datatables()->eloquent($query)
                ->editColumn('contract_no', function (Software $software) {

                    return '<a  class="text-blue-500 font-bold hover:underline" href="' . route('software.details', $software->id) . '" target="_blank"> ' . $software->contract_no . '</a>';
                })
                ->editColumn('current_users', function (Software $software) {
                    $return = "";
                    foreach ($software->user_softwares as $user_softwares) {

                        $return .= "<div>" . $user_softwares->current_users->name . "<br></div>";
                    }
                    $software->current_user_count = count($software->user_softwares);
                    return $return;
                })
                ->editColumn('spare', function (Software $software) {
                    return $software->stocks - $software->current_user_count;
                })
                ->rawColumns(['contract_no', 'current_users'])
                ->toJson();
        }
    }

    public function assign(Request $request)
    {
        $software = Software::findOrFail($request->id);
        $software->user_softwares()->delete();

        foreach ($request->user_id as $user_id) {
            if ($user_id) {
                UserSoftware::create([
                    'user_id' => $user_id,
                    'software_id' => $request->id,

                ]);
            }
        }
        return redirect()->back()->with('success', $software->name . ' has been updated');
    }
}
