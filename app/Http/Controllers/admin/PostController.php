<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\File;
use Auth;
use App\User;
use App\admin\UserInfo;
use App\admin\Post;
use App\admin\PostMusicGenre;
use App\admin\PostVote;

class PostController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    	$this->middleware('admin');
    }

    public function adminPostPage()
    {
        $validPost = Post::where('isValid',1)->get();
        $musicGenre = PostMusicGenre::all();

        return view('admin.posts',compact('validPost','musicGenre'));
    }

    public function add_music_genre(Request $request)
    {
    	$this->validate($request,[
            'music_genre' => 'required|string|max:255'
        ]);

        $isGenreExist = PostMusicGenre::where('title',$request->music_genre)->count();

        if (!$isGenreExist) {
            $genre = new PostMusicGenre;
            $genre->title = $request->music_genre;
            $genre->save();

            return 1;
        }
        return 0;
    }

    public function get_genres()
    {
    	$musicGenre = PostMusicGenre::orderby('music_genre_id','desc')->get();

    	return view('admin.ajax.post.getGenre',compact('musicGenre'));
    }

    public function add_post(Request $request)
    {
    	$this->validate($request,[
    		'genre_id' => 'required|numeric',
    		'post_image' => 'required|image|mimes:jpg,jpeg,png,svg,gif',
    		'post_title' => 'required|string|max:255',
    		'post_desc' => 'required|string',
    		'post_musicroom' => 'required|numeric',
    	]);

    	if ($request->hasFile('post_image')) {
    		$image_name = time().'.'.$request->file('post_image')->getClientOriginalExtension();
    		$request->post_image->move(public_path('images/postImage'),$image_name);

    		Post::insert([
    			'isValid' => 1,
    			'set_musicroom_title' => $request->post_musicroom,
    			'image_url' => $image_name,
    			'user_id' => Auth::user()->id,
    			'text_header' => $request->post_title,
    			'description' => $request->post_desc
    		]);
    		
    		return 1;
    	}

    	return 0;
    }
}
