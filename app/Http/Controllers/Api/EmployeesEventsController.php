<?php

namespace App\Http\Controllers\Api;

use App\EmployeesEvents;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeesEventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employeesEvents = EmployeesEvents::all();
        return response()->json($employeesEvents);
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
        $employeesEvents = new EmployeesEvents();
        $employeesEvents->employee_id = $request->get('employee_id');
        $employeesEvents->course_id = $request->get('course_id');
        $employeesEvents->money = $request->get('money');
        $employeesEvents->save();
        return response()->json($employeesEvents);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employeesEvents = EmployeesEvents::where('employee_id', '=', $id)->with('course')->get();
        return response()->json($employeesEvents);
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
}
