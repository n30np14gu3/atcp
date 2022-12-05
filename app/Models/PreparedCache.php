<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string cache_date
 * @property string category_id
 * @property int position
 */
class PreparedCache extends Model
{
    use HasFactory;

    protected $table = 'prepared_cache';
    public $timestamps = false;


    protected $fillable = [
        'cache_date',
        'category_id',
        'position'
    ];

    protected $casts = [
        'position' => 'integer',
        'category_id' => 'string'
    ];

}
