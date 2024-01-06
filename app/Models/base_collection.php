<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class base_collection extends Model
{
    use HasFactory;
    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'base_collection';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type',
        'description',
        'reward',
        'priority',
        'tags',
    ];

    /**
    * Indicates if the model should be timestamped.
    *
    * @var bool
    */
    public $timestamps = false;
}
