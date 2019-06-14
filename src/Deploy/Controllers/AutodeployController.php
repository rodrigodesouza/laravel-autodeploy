<?php

namespace Bredi\LaravelAutodeploy\Controllers;
use Illuminate\Http\Request;
use Illuminate\Config\Repository;

class AutodeployController
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
        if(file_exists(__DIR__ . '/config.php')) {
            // include __DIR__ . '/config.php';
            $config = require 'config.php';
            dd($config);
            // dd(new Repository($config), $config);
        }
        // echo include 'config.php';
        dd('aqio');

        dd($v);

        dd(new Repository(), $v);
        $config = new Repository($v);

        dd($config);
        // $config = new Repository(require $configPath . 'config.php');

       // echo "This is coming from config/app.php: <hr>" . $config->get('config.name') . "<br><br><br>";

        dd($request->all());

    }
}