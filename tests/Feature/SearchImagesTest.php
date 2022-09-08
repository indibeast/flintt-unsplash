<?php

use Sammyjo20\SaloonLaravel\Facades\Saloon;
use Sammyjo20\Saloon\Http\MockResponse;

test('it can search images from unsplash', function () {
    Saloon::fake([
        MockResponse::make(['results' => [
            [
                'id' => '3uyuwe',
                'description' => 'sample',
                'urls' => ['regular' => 'http//test.me/tt' , 'small' => 'http//test.me/tt'],
                'user' => [
                    'name' => 'test'
                ],
                'created_at' => '2020-01-01',
                'links' => [
                    'download' => 'http//test.me/tt'
                ]
            ]],
            'total' => 1], 200),
    ]);

    $response = $this->get('/images?search=test');
    $response->assertStatus(200);
    $response->assertInertia(fn ($page) => $page
        ->component('ImageSearch')
        ->has(
            'images.items',
            1,
            fn ($page) => $page
                ->where('id', '3uyuwe')
                ->where('description', 'sample')
                ->where('smallUrl', 'http//test.me/tt')
                ->etc()
        )->where('hasSearchParam', true)
        ->where('hasApiError', false)->etc());
});

test('it can handle errors coming from unsplash api', function () {
    Saloon::fake([
        MockResponse::make(['errors' => ["error"]], 500),
    ]);

    $response = $this->get('/images?search=test');
    $response->assertStatus(200);
    $response->assertInertia(
        fn ($page) => $page
        ->component('ImageSearch')
        ->where('images', null)
        ->where('hasSearchParam', true)
        ->where('hasApiError', true)
        ->etc()
    );
});
