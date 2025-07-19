<?php

namespace Workbench\Database\Factories;

use CleaniqueCoders\TokenVault\Models\TokenVault;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @template TModel of \Workbench\App\TokenVault
 *
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<TModel>
 */
class TokenVaultFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<TModel>
     */
    protected $model = TokenVault::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
        ];
    }
}
