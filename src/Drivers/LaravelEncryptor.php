<?php

namespace CleaniqueCoders\TokenVault\Drivers;

use CleaniqueCoders\TokenVault\Contracts\Encryptor;
use Illuminate\Support\Facades\Crypt;

class LaravelEncryptor implements Encryptor
{
    public function encrypt(string $value): string
    {
        return Crypt::encryptString($value);
    }

    public function decrypt(string $value): string
    {
        return Crypt::decryptString($value);
    }
}
