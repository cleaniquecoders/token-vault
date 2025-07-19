<?php

namespace CleaniqueCoders\TokenVault\Contracts;

interface Encryptor
{
    public function encrypt(string $value): string;

    public function decrypt(string $value): string;
}
