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
use App\Models\View;
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

        //log view
        DB::table('items')->where('id', $item_id)->increment('view_count');
        $getView = View::where('user_id', Auth::user()->id)->where('item_id', $item->id)->first();

        if(!$getView){
            View::create([
                'user_id' => Auth::user()->id,
                'item_id' => $item->id,
            ]);
        }
        //Pass it to the course/contents view
        $items = 'yes';


        if (Auth::check()) {
            $getSubscription = CourseUser::where('course_id', $course_id)
                ->where('user_id', Auth::user()->id)->first();
        }


        if (!isset($getSubscription) || !$getSubscription) {
            $getSubscription = 'no';
        }

        $nextItem = Item::where('id', '>', $item->id)->where('course_id', $item->course_id)->min('id');
        $prevItem = Item::where('id', '<', $item->id)->where('course_id', $item->course_id)->min('id');
      

        return view('courses.show')
            ->with('course', $course)
            ->with('items', $items)
            ->with('nextItem', $nextItem)
            ->with('prevItem', $prevItem)
            ->with('getSubscription', $getSubscription)
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



        if (Auth::check()) {
            $getSubscription = CourseUser::where('course_id', $course_id)
                ->where('user_id', Auth::user()->id)->first();
        }


        if (!isset($getSubscription) || !$getSubscription) {
            $getSubscription = 'no';
        }
        
        return view('courses.show')
        ->with('course', $course)
        ->with('getSubscription', $getSubscription)
        ->with('subscribers', $subscribers)
        ;
    }

    public function contents($course_id)
    {
        //Get the list of items that belong to this course

        $course = Course::withCount(['comments', 'items', 'users'])->where('id', $course_id)->first();
        //Pass it to the course/contents view
        $contents = 'yes';

        if (Auth::check()) {
            $getSubscription = CourseUser::where('course_id', $course_id)
                ->where('user_id', Auth::user()->id)->first();
        }


        if (!isset($getSubscription) || !$getSubscription) {
            $getSubscription = 'no';
        }

        return view('courses.show')
            ->with('course', $course)
            ->with('getSubscription', $getSubscription)
            ->with('contents', $contents);
    }



    public function comments($course_id)
    {
        //Get the list of items that belong to this course

        $course = Course::withCount(['comments', 'items', 'users'])->where('id', $course_id)->first();
        //Pass it to the course/contents view
        $comments = 'yes';
          if (Auth::check()) {
            $getSubscription = CourseUser::where('course_id', $course_id)
                ->where('user_id', Auth::user()->id)->first();
        }


        if (!isset($getSubscription) || !$getSubscription) {
            $getSubscription = 'no';
        }

        return view('courses.show')
            ->with('course', $course)
            ->with('getSubscription', $getSubscription)
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
        $mainCourses = Course::where('user_id',Auth::user()->id)
        ->where( 'admin_status', 1)
        ->where( 'creator_status', 1)
        ->get();

        return view('courses.create')
        ->with('categories', $categories)
        ->with( 'mainCourses', $mainCourses)
        ;
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
        if($request->input('main_course_id') ){
            Course::where('id', $course->main_course_id)->update([
                'summary_course_id' => $course->id
            ]);
        }

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

        //get all the summary courses, if this is the main course

        if($course->main_course_id){ //this is a summary course
            //find the main course
             $mainCourse = Course::where('id', $course->main_course_id)->first();

        }

        //get the summary courses if this is a main course
        if(empty($course->main_course_id)){ 
            //get all the courses that has this course as their main course
            $summaryC = Course::where( 'main_course_id', $course->id)->get();
           
            //set the $summaryCourses var only if there are summary courses
            if( $summaryC){
                $summaryCourses = $summaryC;
            }
        }


        if (empty($course)) {
            Flash::error('Course not found');

            return redirect(route('courses.index'));
        }

          //log view
        DB::table('courses')->where('id', $id)->increment('view_count');
        if(Auth::check()){
            $getSubscription = CourseUser::where('course_id', $id)
                ->where('user_id', Auth::user()->id)->first();
                if($getSubscription){
                    Flash::success('You now have full access to this course, scroll down to start viewing the contents');
                    return redirect()->route('courses.contents',['course_id' => $id]);
                }
        }
       

        if(!isset($getSubscription) || !$getSubscription){
            $getSubscription = 'no';
        }


        if(isset($mainCourse)){
            return view('courses.show')
                    ->with('course', $course)
                    ->with('mainCourse', $mainCourse)
                    ->with('description', 'yes')
                    ->with('getSubscription', $getSubscription)
                    ;
        }

        if (isset($summaryCourses)) {
            return view('courses.show')
                ->with('course', $course)
                ->with('summaryCourses', $summaryCourses)
                ->with('description', 'yes')
                ->with('getSubscription', $getSubscription);
        }

        if (isset($summaryCourses) AND isset($summaryCourses)) {
            return view('courses.show')
                ->with('course', $course)
                ->with('summaryCourses', $summaryCourses)
                ->with('description', 'yes')
                ->with('getSubscription', $getSubscription);
        }

        return view('courses.show')
            ->with('course', $course)
            ->with('description', 'yes')
            ->with('getSubscription', $getSubscription);
       
       
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
        $mainCourses = Course::where('user_id', Auth::user()->id)
            ->where('admin_status', 1)
            ->where('creator_status', 1)
            ->get();
            if(isset( $course->main_course_id)){
                 $mainCourse = Course::where('id', $course->main_course_id)->first();
            }
        if (empty($course)) {
            Flash::error('Course not found');

            return redirect(route('courses.index'));
        }

        if(empty( $mainCourse)){
            $mainCourse = 'none';
        }

        $categories = Category::all();
        return view('courses.edit') 
        ->with('course', $course)
        ->with( 'mainCourses', $mainCourses)
        ->with( 'mainCourse', $mainCourse)
        ->with('categories', $categories);
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
