<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $post;
    protected $user;

    public function __construct(Post $post, User $user){
        $this->post = $post;
        $this->user = $user;
    }

    public function createPost(Request $request){
         $request->validate([
            'title' => 'required',
            'body' => 'required',
            'user_id' => 'required',
        ]);

        $postDetails = [
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'user_id' => $request->input('user_id'),
        ];

        if(!$this->post->create($postDetails)){
            return [
                'status' => 'failed',
                'status_code' => 400,
                'message' => 'post post was not created'
            ];
        }
    }


    public function getPost($postId){
        if(!$post = $this->post->find($postId)){
            return [
                'status' => 'failed',
                'status_code' => 400,
                'message' => 'Could not get User post'
            ];
        }

        return [
            'status' => 'success',
            'status_code' => 200,
            'data' => $post
        ];
    }

    public function updatePost($postId, Request $request){
        if(!$post = $this->post->find($postId)){
            return [
                'status' =>'failed',
                'status_code' => 400,
                'message' => 'Failed to Update',
            ];
        }

        $postDetails = [
            'title'=> $request->title,
            'body'=> $request->body,
        ];


        $post->update($postDetails);
        return [
            'status' =>'success',
            'status_code' => 200,
            'data' => $post,
        ];
    }

    public function deletePost($postId){
        $post= $this->post->find($postId);

        if(!$post){
            return [
                'status' =>'failed',
                'message' => 'Could not find Post',
            ];
        }

        $post->delete();

        return [
            'status' =>'success',
            'status_code' => 200,
            'message' => 'Post Deleted',
        ];
    }
}
