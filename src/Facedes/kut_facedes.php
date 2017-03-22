<?php
namespace Acr\Kut\Facedes;

use Illuminate\Support\Facades\Facade;

class kut_facedes extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'acr-kut';
    }
}