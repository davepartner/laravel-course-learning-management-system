<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Item
 * @package App\Models
 * @version February 20, 2019, 11:43 am UTC
 *
 * @property integer user_id
 * @property integer course_id
 * @property integer view_count
 * @property string url
 * @property string description
 */
class Item extends Model
{
    use SoftDeletes;

    public $table = 'items';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'user_id',
        'course_id',
        'view_count',
        'description',
        'url',
        'title',
        'is_free',
        'thumbnail',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'course_id' => 'integer',
        'view_count' => 'integer',
        'is_free' => 'tinyint',
        'thumbnail' => 'string',
        'url' => 'string',
        'title' => 'string',
        'description' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function course()
    {
        return $this->belongsTo('App\Models\Course');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function views()
    {
        return $this->hasMany('App\Models\View');
    }
}
