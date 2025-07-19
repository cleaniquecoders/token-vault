<?php

use CleaniqueCoders\TokenVault\Enums\Provider;
use Workbench\App\Models\User;

it('stores encrypted token and decrypts correctly', function () {
    $user = User::factory()->create();

    $token = $user->tokens()->create([
        'provider' => Provider::GitHub,
        'type' => 'access_token',
        'token' => 'ghp_test123456',
    ]);

    expect($token->token)->not->toBe('ghp_test123456'); // encrypted in DB
    expect($token->getDecryptedToken())->toBe('ghp_test123456');
    expect($token->provider)->toBe(Provider::GitHub);
});

it('detects expired tokens', function () {
    $user = User::factory()->create();

    $token = $user->tokens()->create([
        'provider' => Provider::GitHub,
        'type' => 'access_token',
        'token' => 'ghp_test123456',
        'expires_at' => now()->subDay(),
    ]);

    expect($token->isExpired())->toBeTrue();
    expect($token->provider)->toBe(Provider::GitHub);
});
