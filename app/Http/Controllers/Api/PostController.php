<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Http\Resources\PostResource;
use App\Http\Requests\StorePostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::where('status', 1)->orderBy('created_at', 'desc')->get();

        return PostResource::collection($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendEmail(Post $post, Request $request)
    {
        try{
            $job = (new \App\Jobs\Newsletter($post))
                        ->delay(now()->addSeconds(2));
            dispatch($job);
            return response()->json(['message' => 'Newsletter sent successfully'], 200);
        } catch (\Exception $e) {
            
            DB::rollback();
            return response()->json(['message' => 'Error Occured. ' . $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        DB::beginTransaction();
        try{

            $post = new Post();
            $post->title = $request->title;
            $post->description = $request->description;
            $post->website_id = (int) $request->website_id;
            $post->save();            
            DB::commit();
            
            $job = (new \App\Jobs\Newsletter($post))
                    ->delay(now()->addSeconds(2));
            dispatch($job);
            
            return new PostResource($post);

        } catch (\Exception $e) {
         
            DB::rollback();
            return response()->json(['message' => 'Error Occured. ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
