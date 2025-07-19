<?php

namespace CleaniqueCoders\TokenVault\Commands;

use Illuminate\Console\Command;

class TokenVaultCommand extends Command
{
    public $signature = 'token-vault';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
