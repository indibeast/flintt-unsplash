<?php

namespace App\Images\Unsplash;

use Sammyjo20\Saloon\Http\SaloonRequest;
use Sammyjo20\Saloon\Interfaces\AuthenticatorInterface;

class UnsplashAuthenticator implements AuthenticatorInterface
{
    public function __construct(public $clientId)
    {
    }

    public function set(SaloonRequest $request): void
    {
        $request->addHeader('Authorization', 'Client-ID '.$this->clientId);
    }
}
