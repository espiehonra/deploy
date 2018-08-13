<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use DB;
use Datatables;

class DatatableController extends Controller
{
    public function getUsers(Request $request) {
        echo "test";
        //print_r($request->all());
        $result = User::leftJoin('positions', 'employees.positionId', '=', 'positions.id')
        ->leftJoin('departments', 'employees.iDeptId', '=', 'departments.id')
        ->leftJoin('regions', 'employees.iRegion', '=', 'regions.id')
        ->select('employees.firstname', 'employees.surname','positions.positionName', 'departments.deptName','regions.regionName','employees.isDeactivated')
        ->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
        ->get();
       
        return Datatables::of($result)->make(true);
 
    }

   
}
