<?php

namespace Bredi\LaravelAutodeploy\Controllers;
use Illuminate\Http\Request;
use Illuminate\Config\Repository;

class AutodeployController
{
    public function index(Request $request)
    {
        dd($request->all());
        $path = base_path();
        
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
        $fileConfig = __DIR__ . '/../../Config/config.php';
        if(file_exists($fileConfig)) {
            // $config = require $fileConfig;

            $config = new Repository(require $fileConfig);
            foreach($config->get('commands.servidor') as $command) {
                dd($command);
            }
            
            dd($config->get('config.name'));


            echo "This is coming from config/app.php: <hr>" . $config->get('config.name') . "<br><br><br>";
            

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