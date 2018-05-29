<?php

namespace App\Resolvers;

use Sentinel;

class UserResolver implements \OwenIt\Auditing\Contracts\UserResolver
{
    /**
     * {@inheritdoc}
     */
    public static function resolve()
    {
        return Sentinel::check() ? Sentinel::getUser() : null;
    }
}
