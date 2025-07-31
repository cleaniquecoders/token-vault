<?php

return [
    'encryptor' => \CleaniqueCoders\TokenVault\Drivers\LaravelEncryptor::class,

    'model' => \CleaniqueCoders\TokenVault\Models\TokenVault::class,

    'provider' => \CleaniqueCoders\TokenVault\Enums\Provider::class,

    'cache_ttl' => env('TOKEN_VAULT_CACHE_TTL', 3600),
];
