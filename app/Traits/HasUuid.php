<?php

namespace App\Traits;

use Webpatser\Uuid\Uuid;

trait HasUuid
{
    /**
     * The "booting" method of the model.
     */
    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->{$model->getKeyName()} = (string) Uuid::generate(4);
        });
    }
}
