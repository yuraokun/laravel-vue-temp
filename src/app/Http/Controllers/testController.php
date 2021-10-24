<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class testController extends Controller
{

    private $posts = array(
        ["title" => "世界の定食"],
        ["title" => "本田の定食"],
        ["title" => "近所の定食"],
    );


    public function __construct()
    {
        $this->middleware('auth:admins');
    }

    public function login() {
        return "no";
    }


    // if no action name is defined in route func
    public function __invoke() {

        return "hehe";

        // dd(auth()->guard('admins'));

     
        // cache()->set('name', 'honda');
        // dd(cache()->get('name'));

        ///// sqlのlogの出し方

        // DB::enableQueryLog();
        // // return \App\Models\Post::orderBy('id', 'desc')->take(1)->get();
        // // $authors = \App\Models\Author::all();
        // $authors = \App\Models\Author::with('posts')->get();

        // foreach($authors as $author) {
        //     foreach($author->posts as $post) {
        //         echo $post->title;
        //     }

        // }
        // dd(DB::getQueryLog());

        // return \App\Models\Post::with('author')->get();

        // return \App\Models\Author::with('posts')->get();
    }

    public function find(Request $request) {

        $search_word = $request->input('word');
 

        // return \App\Models\Post::whereHas('author', function($q) use($search_word) {
        //     $q->where('name', 'like', "%$search_word%");
        // })->get();

        // return $search_word;

    //    return \App\Models\Post::with(['author' => function($author) use($search_word) {
    //         return $author->where('name', '=', "%$search_word%");
    //    }])->get();

    $post_ids = \App\Models\Author::where('name', 'like', "%$search_word%")->get(['id']);
    $arr = array();
    foreach($post_ids as $val) {
      $arr[] = $val['id'];
    }
    return \App\Models\Post::with('author')->whereIn('author_id', $arr)->get();
    




    return $post_ids;

    // return \App\Models\Author::where('name','name', '=', "%$search_word%")
  

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return "honda";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return \App\Models\Post::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}