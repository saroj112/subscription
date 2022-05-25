<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Website;
use App\Http\Resources\WebsiteResource;
use App\Http\Requests\WebsiteRequest;

class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $websites = Website::where('status', 1)->orderBy('created_at', 'desc')->get();

        return WebsiteResource::collection($websites);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\WebsiteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function subscribe(WebsiteRequest $request)
    {
        try {
            $website = Website::find($request->website_id);
            $website->users()->sync([$request->user_id]);
            return response()->json(['message' => 'Subscription successful for website ' . $website->name . '.'], 200);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Error Occured. ' . $e->getMessage()], 500);
        }
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
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
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
