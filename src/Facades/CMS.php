<?php

namespace GvsuWebTeam\Cms\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * CMS class 
 */
class CMS extends Facade
{
    protected static function getFacadeAccessor(): string
    {
       return 'cms';
    }
}