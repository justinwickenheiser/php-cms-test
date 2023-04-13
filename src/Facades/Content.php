<?php

namespace GvsuWebTeam\Cms\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Content class 
 */
class Content extends Facade
{
    protected static function getFacadeAccessor(): string
    {
       return 'cms.content';
    }
}