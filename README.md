# Laravel Token Vault

[![Latest Version on Packagist](https://img.shields.io/packagist/v/cleaniquecoders/token-vault.svg?style=flat-square)](https://packagist.org/packages/cleaniquecoders/token-vault)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/cleaniquecoders/token-vault/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/cleaniquecoders/token-vault/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/cleaniquecoders/token-vault/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/cleaniquecoders/token-vault/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/cleaniquecoders/token-vault.svg?style=flat-square)](https://packagist.org/packages/cleaniquecoders/token-vault)

A secure and extensible token manager for Laravel, designed to store, encrypt, and decrypt tokens or API keys. This is useful when you are building an application that require to store sensitive information.

## Installation

You can install the package via composer:

```bash
composer require cleaniquecoders/token-vault
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="token-vault-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="token-vault-config"
```

Here’s the updated **Usage** guide for your `TokenVault` package, incorporating the `Provider` enum and clarifying token types:

## ✅ Usage

### 🧩 Setup Model

To allow a model (e.g. `User`) to have tokens:

```php
use CleaniqueCoders\TokenVault\Concerns\InteractsWithTokenVault;

class User extends Authenticatable
{
    use InteractsWithTokenVault;
}
```

### 🏷️ Available Providers

The package includes predefined providers for common services:

```php
use CleaniqueCoders\TokenVault\Enums\Provider;

// Available providers:
Provider::GitHub      // GitHub tokens
Provider::GitLab      // GitLab tokens
Provider::Bitbucket   // Bitbucket tokens
Provider::Stripe      // Stripe API keys
Provider::Slack       // Slack tokens
Provider::Mailgun     // Mailgun API keys
Provider::AWS         // AWS credentials
Provider::Sentry      // Sentry tokens
Provider::Vercel      // Vercel tokens
Provider::Kong        // Kong Gateway tokens
```

### � Available Token Types

The package supports various token types for different authentication methods:

```php
use CleaniqueCoders\TokenVault\Enums\Type;

// Available token types:
Type::AccessToken           // General access tokens
Type::ApiKey               // API keys for services
Type::BearerToken          // Bearer tokens for authorization headers
Type::RefreshToken         // Tokens for refreshing access tokens
Type::PersonalAccessToken  // User-generated personal tokens
Type::ServiceAccountKey    // Service-to-service authentication keys
Type::WebhookSecret        // Webhook verification secrets
Type::EncryptionKey        // Data encryption keys
Type::CertificateKey       // Private keys for certificates
Type::DatabasePassword     // Database connection passwords
Type::BasicAuth            // Basic authentication credentials
Type::OAuthToken           // OAuth authorization tokens
```

### �🔐 Storing a Token

```php
use CleaniqueCoders\TokenVault\Enums\Provider;
use CleaniqueCoders\TokenVault\Enums\Type;

$user = User::find(1);

// Store a GitHub Personal Access Token
$user->tokens()->create([
    'provider' => Provider::GitHub,
    'type' => Type::PersonalAccessToken,
    'token' => 'ghp_xxxxxxxxxxxxxxxxxxxx',
    'meta' => [
        'name' => 'Deployment Token',
        'scopes' => ['repo', 'workflow'],
        'note' => 'Used for CI/CD deployments'
    ],
    'expires_at' => now()->addYear(),
]);

// Store a Stripe API Key
$user->tokens()->create([
    'provider' => Provider::Stripe,
    'type' => Type::ApiKey,
    'token' => 'sk_live_xxxxxxxxxxxxxxxxxxxx',
    'meta' => [
        'environment' => 'live',
        'permissions' => ['payments', 'customers']
    ],
]);

// Store an AWS Service Account Key
$user->tokens()->create([
    'provider' => Provider::AWS,
    'type' => Type::ServiceAccountKey,
    'token' => json_encode([
        'access_key_id' => 'AKIAIOSFODNN7EXAMPLE',
        'secret_access_key' => 'wJalrXUtnFEMI/K7MDENG/bPxRfiCYEXAMPLEKEY'
    ]),
    'meta' => [
        'region' => 'us-east-1',
        'service' => 'S3'
    ],
]);
```

### 🔓 Retrieving and Decrypting Tokens

```php
$token = $user->tokens()->first();

// Get the decrypted token value
$plainToken = $token->getDecryptedToken();
```

> ⚠️ **Security Warning**: Only decrypt tokens when absolutely necessary and never log or expose raw tokens.

### 👁️ Token Masking (Safe Display)

```php
$token->getMaskedToken(); // Returns: "ghp_****abcd"
```

Perfect for logs, audit trails, or UI displays where you need to show token identification without exposing the actual value.

### 📂 Retrieve Tokens by Provider and Type

```php
use CleaniqueCoders\TokenVault\Enums\Provider;
use CleaniqueCoders\TokenVault\Enums\Type;

// Get all GitHub tokens for a user
$githubTokens = $user->tokens()
    ->where('provider', Provider::GitHub)
    ->get();

// Get a specific Stripe API key
$stripeApiKey = $user->tokens()
    ->where('provider', Provider::Stripe)
    ->where('type', Type::ApiKey)
    ->latest()
    ->first();

// Get all Personal Access Tokens
$personalTokens = $user->tokens()
    ->where('type', Type::PersonalAccessToken)
    ->get();
```

### ⏰ Token Expiration Management

```php
// Check if a token has expired
if ($token->isExpired()) {
    // Handle expired token
    $token->delete();
}

// Clean up all expired tokens for a user
$user->tokens()
    ->where('expires_at', '<', now())
    ->delete();

// Get tokens expiring soon (within 7 days)
$expiringSoon = $user->tokens()
    ->where('expires_at', '>', now())
    ->where('expires_at', '<=', now()->addDays(7))
    ->get();
```

### 🔄 Token Rotation

```php
// Rotate a token (create new, mark old as expired)
$oldToken = $user->tokens()
    ->where('provider', Provider::GitHub)
    ->where('type', Type::PersonalAccessToken)
    ->first();

// Create new token
$newToken = $user->tokens()->create([
    'provider' => Provider::GitHub,
    'type' => Type::PersonalAccessToken,
    'token' => 'ghp_new_token_value',
    'meta' => $oldToken->meta, // Copy metadata
    'expires_at' => now()->addYear(),
]);

// Mark old token as expired
$oldToken->update(['expires_at' => now()]);
```

### 🔍 Advanced Queries

```php
// Get tokens by metadata
$deploymentTokens = $user->tokens()
    ->whereJsonContains('meta->scopes', 'workflow')
    ->get();

// Get non-expired tokens for a specific provider
$activeStripeTokens = $user->tokens()
    ->where('provider', Provider::Stripe)
    ->where(function ($query) {
        $query->whereNull('expires_at')
              ->orWhere('expires_at', '>', now());
    })
    ->get();

// Count tokens by type
$tokenCounts = $user->tokens()
    ->selectRaw('type, count(*) as count')
    ->groupBy('type')
    ->pluck('count', 'type');
```

## Encryption Drivers (Optional)

To use a custom encryption method:

```php
'token-vault.encryptor' => \App\Drivers\OpenSslEncryptor::class,
```

And the class need to implements the `\CleaniqueCoders\TokenVault\Contracts\Encryptor` interface.

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Nasrul Hazim Bin Mohamad](https://github.com/nasrulhazim)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
