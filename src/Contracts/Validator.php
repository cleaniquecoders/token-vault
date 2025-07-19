<?php

namespace CleaniqueCoders\TokenVault\Contracts;

use CleaniqueCoders\TokenVault\Models\TokenVault;

interface Validator
{
    public function validate(TokenVault $tokenVault): bool;
}
