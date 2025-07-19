<?php

namespace CleaniqueCoders\TokenVault\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \CleaniqueCoders\TokenVault\TokenVault
 */
class TokenVault extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \CleaniqueCoders\TokenVault\TokenVault::class;
    }
}
