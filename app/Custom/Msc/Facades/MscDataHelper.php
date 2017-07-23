<?php

namespace App\Custom\Msc\Facades;

use Illuminate\Support\Facades\Facade;

class MscDataHelper extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'MscDataHelper';
    }
}