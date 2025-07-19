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

## Usage

### Setup Model

To allow a model (e.g. `User`) to have tokens:

```php
use CleaniqueCoders\TokenVault\Traits\InteractsWithTokenVault;

class User extends Authenticatable
{
    use InteractsWithTokenVault;
}
```

### Storing a Token

```php
$user = User::find(1);

$user->tokens()->create([
    'type' => 'github',
    'token' => 'ghp_xxxx', // will be encrypted automatically
    'meta' => ['note' => 'GitHub Deploy Token'],
    'expires_at' => now()->addDays(30),
]);
```

### Decrypting a Token (when needed)

```php
$token = $user->tokens()->first();

$plainToken = $token->getDecryptedToken();
```

> Only use this when absolutely necessary — avoid exposing raw tokens.

### Token Masking (Safe Display)

```php
$token->getMaskedToken(); // e.g., "ghp_****abcd"
```

Use this for audit trails or UI displays.

### Retrieve Tokens by Type

```php
$githubToken = $user->tokens()->where('type', 'github')->latest()->first();
```

### Cleaning Expired Tokens

```php
$user->tokens()->where('expires_at', '<', now())->delete();
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
