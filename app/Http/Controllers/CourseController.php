<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Repositories\CourseRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Auth;
use DB;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\Category;
use App\Models\Course;
use App\Models\Item;
use App\Models\CourseUser;

class CourseController extends AppBaseController
{
    /** @var  CourseRepository */
    private $courseRepository;

    public function __construct(CourseRepository $courseRepo)
    {
        $this->courseRepository = $courseRepo;
    }

    public function items($course_id, $item_id)
    {
        //Get the list of items that belong to this course
        // $course = $this->courseRepository->findWithoutFail($course_id);

        $course = Course::withCount(['comments','items','users'])->where('id', $course_id)->first();

        if (empty($course)) {
            Flash::error('Course not found');

            return redirect()->back();
        }

        $item = Item::where('id', $item_id)->first();

        DB::table('items')->where('id', $item_id)->increment('view_count');

        //Pass it to the course/contents view
        $items = 'yes';

        return view('courses.show')
            ->with('course', $course)
            ->with('items', $items)
            ->with('item', $item);
    }

    public function subscribers($course_id){
        //Get the list of items that belong to this course
        $course = Course::withCount(['comments', 'items', 'users'])->where('id', $course_id)->first();

        if (empty($course)) {
            Flash::error('Course not found');

            return redirect()->back();
        }
        //Pass it to the course/contents view
        $subscribers = 'yes';

        return view('courses.show')
        ->with('course', $course)
        ->with('subscribers', $subscribers)
        ;
    }

    public function contents($course_id)
    {
        //Get the list of items that belong to this course

        $course = Course::withCount(['comments', 'items', 'users'])->where('id', $course_id)->first();
        //Pass it to the course/contents view
        $contents = 'yes';

        return view('courses.show')
            ->with('course', $course)
            ->with('contents', $contents);
    }



    public function comments($course_id)
    {
        //Get the list of items that belong to this course

        $course = Course::withCount(['comments', 'items', 'users'])->where('id', $course_id)->first();
        //Pass it to the course/contents view
        $comments = 'yes';

        return view('courses.show')
            ->with('course', $course)
            ->with('comments', $comments);
    }

    public function approve(Request $request)
    {
        Course::where('id', $request->course_id)
        ->update([
            'admin_status' => 1
        ]);

        Flash::success('Course approved successfully.');
        return redirect()->back();

    }

    public function disapprove(Request $request)
    {
        Course::where('id', $request->course_id)
            ->update([
                'admin_status' => 0
            ]);

        Flash::success('Course disapproved successfully.');
        return redirect()->back();
    }

    public function publishCourse(Request $request)
    {
        Course::where('id', $request->course_id)
            ->update([
                'creator_status' => 1
            ]);

        Flash::success('Course published successfully.');
        return redirect()->back();
    }

    public function unpublishCourse(Request $request)
    {
        Course::where('id', $request->course_id)
            ->update([
                'creator_status' => 0
            ]);

        Flash::success('Course unpublished successfully.');
        return redirect()->back();

    }


    /**
     * Display a listing of the Course.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->courseRepository->pushCriteria(new RequestCriteria($request));
        $courses = $this->courseRepository->all();

        return view('courses.index')
            ->with('courses', $courses);
    }

    /**
     * Show the form for creating a new Course.
     *
     * @return Response
     */
    public function create()
    {
        $categories = Category::all();
        
        return view('courses.create')->with('categories', $categories);
    }

    /**
     * Store a newly created Course in storage.
     *
     * @param CreateCourseRequest $request
     *
     * @return Response
     */
    public function store(CreateCourseRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        $course = $this->courseRepository->create($input);

        Flash::success('Course saved successfully.');

        return redirect(route('courses.index'));
    }

    /**
     * Display the specified Course.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {

        $course = Course::withCount(['comments', 'items', 'users'])->where('id', $id)->first();

        if (empty($course)) {
            Flash::error('Course not found');

            return redirect(route('courses.index'));
        }

        if(Auth::check()){
            $getSubscription = CourseUser::where('course_id', $id)
                ->where('user_id', Auth::user()->id)->first();
        }
       

        if(!isset($getSubscription) || !$getSubscription){
            $getSubscription = 'no';
        }

        return view('courses.show')
        ->with('course', $course)
        ->with('description', 'yes')
        ->with('getSubscription', $getSubscription)
        ;
    }

    /**
     * Show the form for editing the specified Course.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $course = $this->courseRepository->findWithoutFail($id);

        if (empty($course)) {
            Flash::error('Course not found');

            return redirect(route('courses.index'));
        }

        return view('courses.edit')->with('course', $course);
    }

    /**
     * Update the specified Course in storage.
     *
     * @param  int              $id
     * @param UpdateCourseRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCourseRequest $request)
    {
        $course = $this->courseRepository->findWithoutFail($id);

        if (empty($course)) {
            Flash::error('Course not found');

            return redirect(route('courses.index'));
        }

        $course = $this->courseRepository->update($request->all(), $id);

        Flash::success('Course updated successfully.');

        return redirect(route('courses.index'));
    }

    /**
     * Remove the specified Course from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $course = $this->courseRepository->findWithoutFail($id);

        if (empty($course)) {
            Flash::error('Course not found');

            return redirect(route('courses.index'));
        }

        if(Auth::check() AND (Auth::user()->role_id < 2 || Auth::user()->id == $course->user_id) ){
              $this->courseRepository->delete($id);   
              Flash::success('Course deleted successfully.'); 
        }
   

       

        return redirect(route('courses.index'));
    }
}
