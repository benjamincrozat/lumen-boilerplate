<?php

namespace App;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasUuid;

    /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [
        'title'   => 'required|unique:posts,title',
        'content' => 'required',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'content',
    ];

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'user',
    ];

    /**
     * Return associated user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
