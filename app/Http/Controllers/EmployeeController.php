<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class EmployeeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // return Http::dd()->get('http://10.134.30.27/portal/public/user/list/api');

        return view('employee.employee');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {

        $user_details = User::findOrFail($request->id);
        return view('employee.details', compact(['user_details']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
            $query = User::select('*')->with('department')->with('team');


            return datatables()->eloquent($query)
                ->editColumn('name', function (User $user) {

                    return '<a  class="text-blue-500 font-bold hover:underline" href="' . route('employee.details', $user->id) . '" target="_blank"><i class="fa-solid fa-eye"></i> ' . $user->name . '</a>';
                })
                ->rawColumns(['name'])
                ->toJson();
        }
    }
}
