<?php

namespace App\Http\Controllers\v1;

use Barryvdh\Debugbar\Controllers\BaseController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller extends BaseController
{
    use AuthorizesRequests;
}
