<?php

namespace CleaniqueCoders\TokenVault\Concerns;

use CleaniqueCoders\TokenVault\Models\TokenVault;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait InteractsWithTokenVault
{
    public function tokens(): MorphMany
    {
        return $this->morphMany(
            config('token-vault.model', TokenVault::class),
            'tokenable'
        );
    }
}
