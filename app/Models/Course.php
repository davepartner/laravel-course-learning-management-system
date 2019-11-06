<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Course
 * @package App\Models
 * @version February 25, 2019, 10:40 am UTC
 *
 * @property integer user_id
 * @property integer category_id
 * @property string title
 * @property string sub_title
 * @property string description
 * @property string about_instructor
 * @property string playlist_url
 * @property string tags
 * @property string photo
 * @property string promo_video_url
 * @property integer creator_status
 * @property integer admin_status
 * @property string what_will_students_learn
 * @property string target_students
 * @property string requirements
 * @property float discount_price
 * @property float actual_price
 * @property integer view_count
 * @property integer subscriber_count
 */
class Course extends Model
{
    use SoftDeletes;

    public $table = 'courses';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'user_id',
        'category_id',
        'title',
        'sub_title',
        'description',
        'about_instructor',
        'playlist_url',
        'tags',
        'photo',
        'promo_video_url',
        'creator_status',
        'admin_status',
        'what_will_students_learn',
        'target_students',
        'requirements',
        'faq',
        'discount_price',
        'actual_price',
        'view_count',
        'subscriber_count',
        'main_course_id',
        'summary_course_id',
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
        'title' => 'string',
        'sub_title' => 'string',
        'description' => 'string',
        'about_instructor' => 'string',
        'playlist_url' => 'string',
        'tags' => 'string',
        'photo' => 'string',
        'promo_video_url' => 'string',
        'creator_status' => 'integer',
        'admin_status' => 'integer',
        'what_will_students_learn' => 'string',
        'target_students' => 'string',
        'requirements' => 'string',
        'faq' => 'string',
        'discount_price' => 'float',
        'actual_price' => 'float',
        'view_count' => 'integer',
        'subscriber_count' => 'integer',
        'main_course_id' => 'integer',
        'summary_course_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * Get the category that owns this users.
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
    
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User')
        ->withPivot('paid_amount')
            ->withPivot('paid_amount')
            ->withPivot('paid_date')
            ->withPivot('expiry_date')
        ->withPivot('plan')
        ->withPivot('created_at')
        ->withPivot('user_account_id')
        ->withPivot('category_id')
        ;
    }

    /**
     * Get the comments for the blog post.
     */
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }
    public function items()
    {
        return $this->hasMany('App\Models\Item');
    }
    public function payments()
    {
        return $this->hasMany('App\Models\Payment');
    }
}
