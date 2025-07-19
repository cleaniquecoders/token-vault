<?php

namespace CleaniqueCoders\TokenVault\Models;

use CleaniqueCoders\TokenVault\Facades\Encryptor;
use CleaniqueCoders\Traitify\Concerns\InteractsWithMeta;
use CleaniqueCoders\Traitify\Concerns\InteractsWithUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class TokenVault extends Model
{
    use HasFactory, InteractsWithMeta, InteractsWithUuid;

    protected $fillable = [
        'provider',
        'type',
        'token',
        'meta',
        'expires_at',
    ];

    protected $casts = [
        'provider' => \CleaniqueCoders\TokenVault\Enums\Provider::class,
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
     * Get masked token for safe display (e.g., ghp_****abcd).
     */
    public function getMaskedToken(): string
    {
        $decrypted = $this->getDecryptedToken();

        return substr($decrypted, 0, 4).str_repeat('*', max(strlen($decrypted) - 8, 0)).substr($decrypted, -4);
    }
}
