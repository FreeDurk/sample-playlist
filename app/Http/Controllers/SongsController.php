<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Song;
use App\Http\Resources\SongsResource;
use App\Http\Requests\SongsRequest;

/**
 * @OA\Get(
 *     path="/api/songs",
 *     summary="List all songs",
 *     @OA\Response(
 *         response=200,
 *         description="OK"
 *     )
 * )
 * 
 * @OA\Get(
 *     path="/api/songs/{id}",
 *     summary="Get Specific song",
 *     @OA\Parameter(
 *         in="path",
 *         name="id",
 *         required=true,
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK"
 *     )
 * )
 * 
 * @OA\Delete(
 *     path="/api/songs/{id}",
 *     summary="Delete Specific song",
 *     @OA\Parameter(
 *         in="path",
 *         name="id",
 *         required=true,
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK"
 *     )
 * )
 * 
 * 
 * @OA\Post(
 *     path="/api/songs",
 *     summary="Store a song",
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(
 *                     property="url",
 *                     type="string"
 *                 ),
 *                 @OA\Property(
 *                     property="title",
 *                     type="string"
 *                 ),
 *                 @OA\Property(
 *                     property="duration",
 *                     type="string"
 *                 ),
 *                 @OA\Property(
 *                     property="artist_name",
 *                     type="string"
 *                 ),
 *                 example={"url": "https://source.unsplash.com/random", "title": "Test Title", "duration": "2:10" , "artist_name" : "Johnny Depp"}
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK"
 *     )
 * )
 * 
 *  @OA\Put(
 *     path="/api/songs/{id}",
 *     summary="Update a song",
 *     @OA\Parameter(
 *         in="path",
 *         name="id",
 *         required=true,
 *     ),
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(
 *                     property="url",
 *                     type="string"
 *                 ),
 *                 @OA\Property(
 *                     property="title",
 *                     type="string"
 *                 ),
 *                 @OA\Property(
 *                     property="duration",
 *                     type="string"
 *                 ),
 *                 @OA\Property(
 *                     property="artist_name",
 *                     type="string"
 *                 ),
 *                 example={"url": "https://source.unsplash.com/random", "title": "Test Title", "duration": "2:10" , "artist_name" : "Johnny Depp"}
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="OK"
 *     )
 * )
 * 
 */

class SongsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$songs = Song::paginate();
        return (SongsResource::collection($songs))->response()->setStatusCode(200);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SongsRequest $request)
    {
        $new_song = Song::create( $request->validated() );
		return (new SongsResource($new_song))->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Song $song)
    {
        return (new SongsResource($song))->response()->setStatusCode(200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Song $song)
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
    public function update(SongsRequest $request, Song $song)
    {
		$song->update( $request->validated() );
		return (new SongsResource($song))->response()->setStatusCode(200);
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Song $song)
    {
        $song->delete();
		return response()->noContent();
    }
}
