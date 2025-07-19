<?php

namespace CleaniqueCoders\TokenVault\Validators;

use CleaniqueCoders\TokenVault\Contracts\Validator;
use CleaniqueCoders\TokenVault\Models\TokenVault;

class GitHubTokenValidator implements Validator
{
    public function validate(TokenVault $tokenVault): bool
    {
        return false;
    }
}
