<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class View
 * @package App\Models
 * @version February 20, 2019, 11:44 am UTC
 *
 * @property integer user_id
 * @property integer user_account_id
 * @property integer category_id
 * @property integer course_id
 * @property integer item_id
 */
class View extends Model
{
    use SoftDeletes;

    public $table = 'views';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'user_id',
        'user_account_id',
        'category_id',
        'course_id',
        'item_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'user_account_id' => 'integer',
        'category_id' => 'integer',
        'course_id' => 'integer',
        'item_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function item()
    {
        return $this->belongsTo('App\Models\Item');
    }

}
