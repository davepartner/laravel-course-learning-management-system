<?php

namespace App\Repositories;

use App\Models\Course;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CourseRepository
 * @package App\Repositories
 * @version February 25, 2019, 10:40 am UTC
 *
 * @method Course findWithoutFail($id, $columns = ['*'])
 * @method Course find($id, $columns = ['*'])
 * @method Course first($columns = ['*'])
*/
class CourseRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'category_id',
        'title',
        'sub_title',
        'description',
        'faq',
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
        'discount_price',
        'actual_price',
        'view_count',
        'subscriber_count',
        'main_course_id',
        'summary_course_id',
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Course::class;
    }
}
