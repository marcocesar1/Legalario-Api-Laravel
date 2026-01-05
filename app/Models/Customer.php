<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Customer extends Model
{
    protected $fillable = [
        'name',
        'email',
        'age',
        'country',
    ];

    protected $cast = [
        'age' => 'integer',
    ];

    /**
     * Interact with the country attribute.
     */
    protected function country(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => strtoupper($value),
        );
    }
}
