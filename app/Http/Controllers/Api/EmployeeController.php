<?php

namespace App\Http\Controllers\Api;

use App\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = Employee::with('branch')->with('department')->get();
        return response()->json($employee);
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
        $employee = new Employee();
        $employee->name_title = $request->get('name_title');
        $employee->firstname = $request->get('firstname');
        $employee->lastname = $request->get('lastname');
        $employee->employee_code = $request->get('employee_code');
        $employee->department_id = $request->get('department_id');
        $employee->position = $request->get('position');
        $employee->branch_id = $request->get('branch_id');
        $employee->start_date = $request->get('start_date');
        $employee->end_date = $request->get('end_date');
        $employee->save();
        return response()->json($employee);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::where('employee_code', '=', $id)->get();
        return response()->json($employee);
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
        $employee = Employee::find($id);
        $employee->name_title = $request->get('name_title');
        $employee->firstname = $request->get('firstname');
        $employee->lastname = $request->get('lastname');
        $employee->employee_code = $request->get('employee_code');
        $employee->department_id = $request->get('department_id');
        $employee->position = $request->get('position');
        $employee->branch_id = $request->get('branch_id');
        $employee->start_date = $request->get('start_date');
        $employee->end_date = $request->get('end_date');
        $employee->update();
        return response()->json($employee);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);
        $employee->delete();
        return response()->json($employee);
    }
}
