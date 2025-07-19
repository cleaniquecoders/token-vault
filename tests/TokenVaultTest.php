<?php

use Workbench\App\Models\User;

it('stores encrypted token and decrypts correctly', function () {
    $user = User::factory()->create();

    $token = $user->tokens()->create([
        'type' => 'github',
        'token' => 'ghp_test123456',
    ]);

    expect($token->token)->not->toBe('ghp_test123456');
    expect($token->getDecryptedToken())->toBe('ghp_test123456');
});

it('detects expired tokens', function () {

    $user = User::factory()->create();

    $token = $user->tokens()->create([
        'type' => 'github',
        'token' => 'ghp_test123456',
        'expires_at' => now()->subDay(),
    ]);

    expect($token->isExpired())->toBeTrue();
});

it('validates token based on mocked validator', function () {
    $user = User::factory()->create();

    $token = $user->tokens()->create([
        'type' => 'github',
        'token' => 'ghp_testtoken',
    ]);

    expect($token->isValid())->toBeTrue();
});
