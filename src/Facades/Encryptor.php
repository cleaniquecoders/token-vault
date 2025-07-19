<?php

namespace CleaniqueCoders\TokenVault\Facades;

use Illuminate\Support\Facades\Facade;

class Encryptor extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'token-vault.encryptor';
    }
}
