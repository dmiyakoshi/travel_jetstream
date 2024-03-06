<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class MyfunctionFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Myfunction';
    }
}
