<?php

use App\Models\Image;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Sammyjo20\SaloonLaravel\Facades\Saloon;
use Sammyjo20\Saloon\Http\MockResponse;

uses(RefreshDatabase::class);

test('it can save image', function () {
    expect(Image::count())->toBe(0);

    Storage::fake();
    Mockery::mock('alias:\App\Support\FileContent')->shouldReceive('fromUrl')->andReturn('image data');
    Saloon::fake([
        MockResponse::make([
            'id' => '1234',
            'description' => 'sample',
            'urls' => ['regular' => 'http://test.me/tt', 'small' => 'http://test.me/tt'],
            'user' => [
                'name' => 'test'
            ],
            'created_at' => '2020-01-01',
            'links' => [
                'download' => 'http://test.me/tt'
            ]
        ], 200),
    ]);

    $response = $this->post('/image-download', ['id' => '1234']);

    $response->assertStatus(302);

    expect(Image::count())->toBe(1);

    tap(Image::first(), function ($image) {
        expect($image->description)->toBe('sample');
        expect($image->unsplash_id)->toBe('1234');
    });
});

test('you cannot re-download image if it is already saved', function () {
    $image = Image::factory()->create(['unsplash_id' => 'existing_id']);

    expect(Image::count())->toBe(1);

    Saloon::fake([
        MockResponse::make([
            'id' => 'existing_id',
            'description' => 'sample',
            'urls' => ['regular' => 'http://test.me/tt', 'small' => 'http://test.me/tt'],
            'user' => [
                'name' => 'test'
            ],
            'created_at' => '2020-01-01',
            'links' => [
                'download' => 'http://test.me/tt'
            ]
        ], 200),
    ]);

    $response = $this->post('/image-download', ['id' => 'existing_id']);
    $response->assertSessionHasErrors('id');

    expect(Image::count())->toBe(1);
});
