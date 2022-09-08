<?php

namespace App\Images\Unsplash\Requests;

use App\Dto\ImageData;
use App\Dto\PaginationData;
use App\Images\Unsplash\UnsplashConnector;
use Illuminate\Support\Arr;
use Sammyjo20\Saloon\Constants\Saloon;
use Sammyjo20\Saloon\Http\SaloonRequest;
use Sammyjo20\Saloon\Http\SaloonResponse;
use Sammyjo20\Saloon\Traits\Plugins\CastsToDto;

class SearchImagesRequest extends SaloonRequest
{
    use CastsToDto;

    /**
     * The connector class.
     *
     * @var string|null
     */
    protected ?string $connector = UnsplashConnector::class;

    /**
     * The HTTP verb the request will use.
     *
     * @var string|null
     */
    protected ?string $method = Saloon::GET;

    public function __construct(public string $search)
    {
    }
    /**
     * The endpoint of the request.
     *
     * @return string
     */
    public function defineEndpoint(): string
    {
        return '/search/photos';
    }

    public function defaultQuery(): array
    {
        return [
            'query' => $this->search,
        ];
    }

    protected function castToDto(SaloonResponse $response): mixed
    {
        $data = $response->json();

        $items = collect(Arr::get($data, 'results'))->map(fn ($result) => ImageData::fromUnsplash($result))->all();

        return PaginationData::make(items: $items, totalItems: Arr::get($data, 'total', 0), perPage: 20, currentPage: $this->getQuery('page') ?? 1);
    }
}
