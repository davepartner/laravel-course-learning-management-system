<?php

namespace App\Repositories;

use App\Models\CourseUser;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CourseUserRepository
 * @package App\Repositories
 * @version February 20, 2019, 11:42 am UTC
 *
 * @method CourseUser findWithoutFail($id, $columns = ['*'])
 * @method CourseUser find($id, $columns = ['*'])
 * @method CourseUser first($columns = ['*'])
*/
class CourseUserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'course_id',
        'user_account_id',
        'paid_date',
        'expiry_date',
        'plan',
        'paid_amount',
        'status'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CourseUser::class;
    }
}
