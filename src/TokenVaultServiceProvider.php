<?php

namespace CleaniqueCoders\TokenVault;

use Exception;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class TokenVaultServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('token-vault')
            ->hasConfigFile()
            ->hasMigration('create_token_vault_table');
    }

    public function packageRegistered()
    {
        $this->app->singleton('token-vault.encryptor', function () {
            $class = config('token-vault.encryptor');

            if (! class_exists($class)) {
                throw new Exception("$class not found");
            }

            $instance = new $class;

            if (! ($instance instanceof \CleaniqueCoders\TokenVault\Contracts\Encryptor)) {
                throw new Exception("$class must implement \CleaniqueCoders\TokenVault\Contracts\Encryptor interface");
            }

            return $instance;
        });
    }
}
