<?php

namespace Bredi\LaravelAutodeploy\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

use Clousure;

class TokenExcept  extends Middleware 
{

    protected $except = [
        'autodeploy/*'
    ];
}