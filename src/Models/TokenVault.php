<?php

namespace CleaniqueCoders\TokenVault\Models;

use CleaniqueCoders\TokenVault\Facades\Encryptor;
use CleaniqueCoders\Traitify\Concerns\InteractsWithUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;

class TokenVault extends Model
{
    use HasFactory, InteractsWithUuid;

    protected $fillable = [
        'type',
        'token',
        'meta',
        'expires_at',
    ];

    protected $casts = [
        'meta' => 'array',
        'expires_at' => 'datetime',
    ];

    /**
     * Polymorphic relationship to tokenable model.
     */
    public function tokenable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Mutator to encrypt token on save.
     */
    public function setTokenAttribute($value): void
    {
        $this->attributes['token'] = Encryptor::encrypt($value);
    }

    /**
     * Accessor to get decrypted token value.
     */
    public function getDecryptedToken(): string
    {
        return Encryptor::decrypt($this->attributes['token']);
    }

    /**
     * Check if token has expired.
     */
    public function isExpired(): bool
    {
        return $this->expires_at?->isPast() ?? false;
    }

    /**
     * Check if the token is valid using its registered validator.
     */
    public function isValid(): bool
    {
        $cacheKey = "token-vault.validity.{$this->id}";

        return Cache::remember($cacheKey, config('token-vault.cache_ttl', 3600), function () {
            $validator = config("token-vault.validators.{$this->type}");

            if (! $validator) {
                return true; // No validator, assume valid
            }

            return App::make($validator)->validate($this);
        });
    }

    /**
     * Get masked token for safe display (e.g., ghp_****abcd).
     */
    public function getMaskedToken(): string
    {
        $decrypted = $this->getDecryptedToken();

        return substr($decrypted, 0, 4).str_repeat('*', max(strlen($decrypted) - 8, 0)).substr($decrypted, -4);
    }
}
