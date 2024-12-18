<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Caching extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'caching'; 
    }
}
