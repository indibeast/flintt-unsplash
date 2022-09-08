<?php

namespace App\Images\Unsplash\Requests;

use App\Dto\ImageData;
use App\Images\Unsplash\UnsplashConnector;
use Sammyjo20\Saloon\Constants\Saloon;
use Sammyjo20\Saloon\Http\SaloonRequest;
use Sammyjo20\Saloon\Http\SaloonResponse;
use Sammyjo20\Saloon\Traits\Plugins\CastsToDto;

class GetImageRequest extends SaloonRequest
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

    public function __construct(public string $id)
    {
    }
    /**
     * The endpoint of the request.
     *
     * @return string
     */
    public function defineEndpoint(): string
    {
        return '/photos/' . $this->id;
    }

    protected function castToDto(SaloonResponse $response): mixed
    {
        $data = $response->json();

        return ImageData::fromUnsplash($data);
    }
}
