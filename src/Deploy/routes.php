<?php
use Illuminate\Routing\Router;





/** @var $router Router */
$router->get('/api/webhookv2', function () {
    return 'hello world!';
});
$router->get('/foo', function () {
    // 
    // $config = require __DIR__.'/Controllers/config.php';
    // dd($config);
    // Get config using the get method
    
    // Get config using ArrayAccess
    // echo "This is coming from config/app.php: <hr>" . $config['app.user'] . "<br><br>";
    // Set a config
    // $config->set('settings.greeting', 'Hello there how are you?');
    // echo "Set using config->set: <hr>" . $config->get('settings.greeting');

    return 'hello world!';
});
$router->get('bye', function () {
    return 'goodbye world! SIM';
});
$router->group(['namespace' => 'Bredi\LaravelAutodeploy\Controllers', 'prefix' => 'autodeploy'], function (Router $router) {
    $router->get('/webhookv2', function(){
        // die('aqio');
        return 'users';
    });

    $router->post('/users', ['name' => 'users.index', 'uses' => 'UsersController@index']);//->middleware('guest', );

    $router->post('/recept', ['name' => 'webhook.index', 'uses' => 'AutodeployController@webhook']);

    // $router->get('/', ['name' => 'users.index', 'uses' => 'UsersController@index']);
    // $router->post('/', ['name' => 'users.store', 'uses' => 'UsersController@store']);
});
$router->group(['namespace' => 'Bredi\LaravelAutodeploy\Controllers', 'prefix' => 'autodeploy'], function (Router $router) {
});

// catch-all route
// $router->any('{any}', function () {
//     return 'four oh four';
// })->where('any', '(.*)');