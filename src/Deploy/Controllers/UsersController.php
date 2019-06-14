<?php

namespace Bredi\LaravelAutodeploy\Controllers;
use Illuminate\Http\Request;

class UsersController
{
    public function index(Request $request)
    {
        dd($request->all());
        
        return "
            listing the users
            <br>
            <br>
            <form method='post'>
            <input type='text' name='name'>
            <input type='submit'>
            </form>";
    }
    public function store(Request $request)
    {
        $name = $request->input('name');
        return "creating new user named $name";
    }

    public function webhook(Request $request)
    {
        dd($request->all());

    }
}