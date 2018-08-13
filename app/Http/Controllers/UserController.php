<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use DB;
use Datatables;

class UserController extends Controller
{
    public function index()
    {
        $result = User::leftJoin('positions', 'employees.positionId', '=', 'positions.id')
        ->leftJoin('departments', 'employees.iDeptId', '=', 'departments.id')
        ->leftJoin('regions', 'employees.iRegion', '=', 'regions.id')
        ->select('employees.*', 'positions.positionName', 'departments.deptName','regions.regionName')
        ->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
        ->get();
        $positions = DB::select('SELECT * FROM positions ORDER BY positionName ASC ');
        $departments = DB::select('SELECT * FROM departments ORDER BY deptName ASC ');
        $regions = DB::select('SELECT * FROM regions ORDER BY regionName ASC ');
        $user = auth()->user();
        $employees=User::orderBy('id','desc')->get();
        $data=array(
            'empno'=>$user->empno,
            'password'=>$user->password,
            'employees'=>$result,
            'userLevel'=>$user->userLevel,
            'positions'=>$positions,
            "departments"=>$departments,
            "regions"=>$regions
        );
        return view('employees.index')->with($data);
    }

    public function activate(Request $request){
        $user = User::find($request->id);
        $user->isDeactivated =$request->type;
        $user->save();       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUsers(Request $request)
    {
        $result = User::leftJoin('positions', 'employees.positionId', '=', 'positions.id')
        ->leftJoin('departments', 'employees.iDeptId', '=', 'departments.id')
        ->leftJoin('regions', 'employees.iRegion', '=', 'regions.id')
        ->select('employees.firstname', 'employees.surname','positions.positionName', 'departments.deptName','regions.regionName','employees.isDeactivated')
        ->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
        ->get();
       
        return Datatables::of($result)->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
        //            data:{"type":type,"editType":editType,"id":id},
       $id=$request->id;
        $editType=$request->editType;
        echo $id."-id-".$editType;

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
}
