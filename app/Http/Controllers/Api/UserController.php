<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $users = User::orderBy('firstname', 'asc')->with('department')->get();
        return response()->json($users);
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
        $user = new User();
        $user->name_title = $request->get('name_title');
        $user->firstname = $request->get('firstname');
        $user->lastname = $request->get('lastname');
        $user->sex = $request->get('sex');
        $user->code = $request->get('code');
        $user->department = $request->get('department');
        $user->position = $request->get('position');
        $user->email = $request->get('email');
        $user->start_date = $request->get('start_date');
        $user->password = bcrypt($request->get('password'));
        $user->save();
        return response()->json($user);

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
        $user = User::find($id);
        $user->name_title = $request->get('name_title');
        $user->firstname = $request->get('firstname');
        $user->lastname = $request->get('lastname');
        $user->code = $request->get('code');
        $user->sex = $request->get('sex');
        $user->department = $request->get('department');
        $user->position = $request->get('position');
        $user->email = $request->get('email');
        $user->update();
        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json($user);
    }
}
