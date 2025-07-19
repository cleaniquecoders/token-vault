<?php

return [
    'encryptor' => \CleaniqueCoders\TokenVault\Drivers\LaravelEncryptor::class,

    'cache_ttl' => env('TOKEN_VAULT_CACHE_TTL', 3600),
];
