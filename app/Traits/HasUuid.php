<?php

namespace App\Traits;

use Illuminate\Support\Str;

/**
 * This trait adds UUID generation to your primary key
 * everytime a new model is created. Make sure your
 * column is property configured as an UUID type.
 */
trait HasUuid
{
    /**
     * The "booting" method of the model.
     */
    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->{$model->getKeyName()} = (string) Str::uuid();
        });
    }
}
