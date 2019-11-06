<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Payment
 * @package App\Models
 * @version February 20, 2019, 11:43 am UTC
 *
 * @property integer user_id
 * @property integer category_id
 * @property integer course_id
 * @property float amount
 * @property string status
 * @property string mode_of_payment
 * @property string payment_processor
 */
class Payment extends Model
{
    use SoftDeletes;

    public $table = 'payments';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'user_id',
        'category_id',
        'course_id',
        'amount', 'proof_of_payment','name_of_depositor',
        'status',
        'mode_of_payment',
        'payment_processor',
        'refund_payment_details',
        'refund_details'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'category_id' => 'integer',
        'course_id' => 'integer',
        'amount' => 'float',
        'proof_of_payment'=>'string', 
        'name_of_depositor' => 'string',
        'status' => 'string',
        'mode_of_payment' => 'string',
        'payment_processor' => 'string',
        'refund_payment_details' => 'string',
        'refund_details' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];


    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function course()
    {
        return $this->belongsTo('App\Models\Course');
    }
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    
}
