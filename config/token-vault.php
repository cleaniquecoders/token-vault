<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Token Vault Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains the configuration settings for the Token Vault package.
    | You can customize the behavior of token storage, encryption, and caching
    | according to your application's requirements.
    |
    */

    /*
    |--------------------------------------------------------------------------
    | Core Components
    |--------------------------------------------------------------------------
    |
    | These settings define the core components used by the Token Vault.
    | You can swap out implementations to customize the behavior.
    |
    */

    'model' => \CleaniqueCoders\TokenVault\Models\TokenVault::class,

    'encryptor' => \CleaniqueCoders\TokenVault\Drivers\LaravelEncryptor::class,

    /*
    |--------------------------------------------------------------------------
    | Enumerations
    |--------------------------------------------------------------------------
    |
    | These enums define the available providers and token types that can be
    | stored in the vault. You can extend these enums or create custom ones
    | to match your application's specific requirements.
    |
    */

    'provider' => \CleaniqueCoders\TokenVault\Enums\Provider::class,

    'type' => \CleaniqueCoders\TokenVault\Enums\Type::class,

    /*
    |--------------------------------------------------------------------------
    | Caching Configuration
    |--------------------------------------------------------------------------
    |
    | Configure caching behavior for token retrieval operations.
    | The TTL (Time To Live) is specified in seconds.
    |
    */

    'cache_ttl' => env('TOKEN_VAULT_CACHE_TTL', 3600), // 1 hour
];
