<?php

namespace CleaniqueCoders\TokenVault;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use CleaniqueCoders\TokenVault\Commands\TokenVaultCommand;

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
            ->hasViews()
            ->hasMigration('create_token_vault_table')
            ->hasCommand(TokenVaultCommand::class);
    }
}
