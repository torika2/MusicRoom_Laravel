<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\admin\Post;

class ClientPagesController extends Controller
{
    public function __construct()
    {
    	// $this->middleware('auth');
    }

    public function welcome()
    {

        $post = Post::selectRaw("`name`,`admin`,`posts`.`post_id`,IFNULL(count(`vote_id`),0) as 'votes',`title`,`set_musicroom_title`,`image_url`,`text_header`,`description`")->join('post_music_genres','music_genre_id','post_genre_id')->leftJoin('post_votes','post_votes.post_id','posts.post_id')->join('users','users.id','posts.user_id')->groupBy('posts.post_id')->get();

        return view('welcome',compact('post'));
    }

    // public function get_post()
    // {
    //     $post = Post::selectRaw("`name`,`admin`,`posts`.`post_id`,count(`vote_id`) as 'votes',`title`,`set_musicroom_title`,`image_url`,`text_header`,`description`")->join('post_music_genres','music_genre_id','post_genre_id')->leftJoin('post_votes','post_votes.post_id','posts.post_id')->join('users','users.id','posts.user_id')->groupBy('posts.post_id')->get();
        
    //     return view('admin.ajax.post.getPost',compact('post'));
    // }
}
