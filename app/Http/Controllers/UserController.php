<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //search query
        $actualQuery = Request::all('search');

        return Inertia::render('Users/Index', [
            'users' => User::query()
                ->join('roles', 'role_id', '=', 'roles.id')
                ->select('users.id', 'users.name', 'users.email', 'roles.name as role')
                ->when($actualQuery['search'], function ($query, $search){
                    $query->where('users.name', 'like', "%{$search}%");
                })
                ->paginate(10)
                ->withQueryString(),
            'query' => [ 'filters' => $actualQuery['search'] , 'table' => 'users']
            ]);
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
    public function edit(User $user)
    {
        // $id = $user->id;
        return Inertia::render('users.edit', ['user' => $user]);
        // return Inertia::render("users/{$user}/Edit");
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
