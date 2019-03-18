<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Repositories\ItemRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Auth;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Illuminate\Support\Facades\DB;
use Youtube;
use App\Models\Item;
use App\Models\Course;

class ItemController extends AppBaseController
{
    /** @var  ItemRepository */
    private $itemRepository;

    public function __construct(ItemRepository $itemRepo)
    {
        $this->itemRepository = $itemRepo;
    }

    /**
     * Display a listing of the Item.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->itemRepository->pushCriteria(new RequestCriteria($request));
        $items = $this->itemRepository->all();

        return view('items.index')
            ->with('items', $items);
    }

    /**
     * Show the form for creating a new Item.
     *
     * @return Response
     */
    public function create($course_id)
    {
        $course = Course::find($course_id);

        return view('items.create')->with('course_id', $course_id)->with('course', $course);
    }

    public function importYoutube(Request $request)
    {
        //goes to youtube, fetches all the videos in the playlist
        //course_id
        //playlist_url 

        /**
         * Youtube playlist
         * Check playlist status: public, private, unlisted
         * Create items acording to playlist items
         */

        $input = $request->input();

        $string = $input['youtube_playlist_url'];

        $url = parse_url($string);

        if(isset($url['query'])){
            
            parse_str($url['query'], $q);
            $list = $q['list'];
        }else{
            Flash::error('Error: Please paste correct youtube playlist url');
            return redirect()->back();
        }
        

        // Get items in a playlist by playlist ID, return an array of PHP objects
        $playlistItems = Youtube::getPlaylistItemsByPlaylistId($list);
       //create new records for each playlist item

   foreach($playlistItems['results'] as $playlistItem){

    $itemUrl = 'https://www.youtube.com/watch?v=' . $playlistItem->contentDetails->videoId;

       //create new item in db
        $checkItem = Item::where('course_id', $input['course_id'])
        ->where('url', $itemUrl)->first();

        if(isset($playlistItem->snippet->thumbnails->default->url)){
            $thumbnail = $playlistItem->snippet->thumbnails->default->url;
        }else{
            $thumbnail = '';
        }

       $course = Course::find($item->thumbnail);
        if($course->actual_price == 0){ //meaning this course is free
                $is_free = 1;
        }else{
                $is_free = 0;
        }

        if(!$checkItem){
            Item::create([
                    'course_id'=> $input['course_id'],
                    'url' => $itemUrl,
                    'is_free' => $is_free,
                    'thumbnail' => $thumbnail,
                    'description' => $playlistItem->snippet->description,
                    'title' => $playlistItem->snippet->title,
                    'user_id' => Auth::user()->id
                    ]);
        }else{
                Item::where('id', $checkItem->id )->update([
                    'course_id' => $input['course_id'],
                    'url' => $itemUrl,
                    'thumbnail' => $thumbnail,
                    'description' => $playlistItem->snippet->description,
                    'title' => $playlistItem->snippet->title,
                    'user_id' => Auth::user()->id
                ]);
        }
      
   }

        Flash::success('Item imported successfully. Scroll down to view imported items');

        return redirect()->back();

    }

    /**
     * Store a newly created Item in storage.
     *
     * @param CreateItemRequest $request
     *
     * @return Response
     */
    public function store(CreateItemRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;

        $course = Course::find($input['course_id']);
        if ($course->actual_price == 0) { //meaning this course is free
            $is_free = 1;
        } else {
            $is_free = 0;
        }
             $input['is_free'] = $is_free;

        $item = $this->itemRepository->create($input);

        Flash::success('Item created successfully.');

        return redirect(route('courses.contents',['course_id'=> $input['course_id'],'contents' => 'yes' ]));
           
    }

    /**
     * Display the specified Item.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $item = $this->itemRepository->findWithoutFail($id);

        if (empty($item)) {
            Flash::error('Item not found');

            return redirect(route('courses.index'));
        }
        DB::table('items')->where('id', $id)->increment('view_count');
        return view('items.show')->with('item', $item);
    }

    /**
     * Show the form for editing the specified Item.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $item = $this->itemRepository->findWithoutFail($id);

        if (empty($item)) {
            Flash::error('Item not found');

            return redirect(route('courses.index'));
        }
        $course = Course::find($item->course_id);

        return view('items.edit')
        ->with('item', $item)
        ->with('course', $course)
        ->with('course_id', $item->course_id);
    }

    /**
     * Update the specified Item in storage.
     *
     * @param  int              $id
     * @param UpdateItemRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateItemRequest $request)
    {
        $item = $this->itemRepository->findWithoutFail($id);

        if (empty($item)) {
            Flash::error('Item not found');

            return redirect(route('courses.index'));
        }

        $item = $this->itemRepository->update($request->all(), $id);

        Flash::success('Item updated successfully.');

        return redirect(route('courses.items',['course_id'=> $item->course_id, 'item_id'=> $item->id]));
         
    }

    /**
     * Remove the specified Item from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $item = $this->itemRepository->findWithoutFail($id);

        if (empty($item)) {
            Flash::error('Item not found');

            return redirect(route('courses.index'));
        }
        if (Auth::check() and (Auth::user()->role_id < 2 || Auth::user()->id == $item->user_id)) {
        $this->itemRepository->delete($id);

        Flash::success('Item deleted successfully.');
        }

        return redirect(route('courses.contents',['course_id'=> $item->course_id, 'contents'=>'yes']));
    }
}
