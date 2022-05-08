<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Song;
use App\Http\Resources\SongsResource;
use Illuminate\Http\Request;

class SongTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
	public function testRequiredFields(){
		$this->json('POST', 'api/songs', ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => []
            ]);
	}

	public function testSongList(){
		Song::factory()->create([
			"url" => "https://source.unsplash.com/random",
			"title" => "Test 1",
			"duration" => "2:10",
			"artist_name" => "Johnny Depp"
        ]);

		Song::factory()->create([
			"url" => "https://source.unsplash.com/random",
			"title" => "Test 2",
			"duration" => "1:30",
			"artist_name" => "Johnny Depp"
        ]);

		Song::factory()->create([
			"url" => "https://source.unsplash.com/random",
			"title" => "Test 3",
			"duration" => "1:30",
			"artist_name" => "Johnny Depp"
        ]);

		$request_list = $this->get('api/songs' ,  ['Accept' => 'application/json']);
		

		$this->json('GET', 'api/songs', ['Accept' => 'application/json'])
            ->assertStatus(200)
			->assertJson([
				"data" => [
					[
						"url" => "https://source.unsplash.com/random",
						"title" => "Test 1",
						"duration" => "2:10",
						"artist_name" => "Johnny Depp"
					],
					[
						"url" => "https://source.unsplash.com/random",
						"title" => "Test 2",
						"duration" => "1:30",
						"artist_name" => "Johnny Depp"
					],
					[
						"url" => "https://source.unsplash.com/random",
						"title" => "Test 3",
						"duration" => "1:30",
						"artist_name" => "Johnny Depp"
					]
				]
			]);
    }

	public function testCreateSong(){
		$song = [
			"url" => "https://source.unsplash.com/random",
			"title" => "Sample Title for Testing",
			"duration" => "2:10",
			"artist_name" => "Johnny Depp"
		];
		
		$this->json('POST', 'api/songs', $song, ['Accept' => 'application/json'])
            ->assertStatus(201)
			->assertJson([
				"data" => [
					"url" => "https://source.unsplash.com/random",
					"title" => "Sample Title for Testing",
					"duration" => "2:10",
					"artist_name" => "Johnny Depp"
				]
			])
            ->assertJsonStructure([
                "data" => [
                    'url',
                    'title',
                    'duration',
					'artist_name',
                    'created_at',
                    'updated_at',
					'id'
                ]
            ]);

	}

	public function testUpdateSong(){
		$song = Song::factory()->create([
			"url" => "https://source.unsplash.com/random",
			"title" => "Test 1",
			"duration" => "2:10",
			"artist_name" => "Johnny Depp"
        ]);

		$updated_song = [
			"url" => "https://source.unsplash.com/random",
			"title" => "Updated Test 1",
			"duration" => "2:50",
			"artist_name" => "New Artist Name"
		];

		$this->putJson('api/songs/'.$song->id , $updated_song ,  ['Accept' => 'application/json'])
		->assertStatus(200)
		->assertJson([
			"data" => [
				"url" => "https://source.unsplash.com/random",
				"title" => "Updated Test 1",
				"duration" => "2:50",
				"artist_name" => "New Artist Name",
			]
		]);
	}

	public function testDeleteSong(){
		$song = Song::factory()->create([
			"url" => "https://source.unsplash.com/random",
			"title" => "Test Delete 1",
			"duration" => "2:10",
			"artist_name" => "Johnny Depp"
        ]);

		$this->deleteJson('api/songs/'.$song->id , ['Accept' => 'application/json'])
		->assertStatus(204);
	
	}
}
