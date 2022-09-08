<?php

namespace App\Images\Unsplash;

use Sammyjo20\Saloon\Http\SaloonConnector;
use Sammyjo20\Saloon\Interfaces\AuthenticatorInterface;
use Sammyjo20\Saloon\Traits\Auth\RequiresAuth;
use Sammyjo20\Saloon\Traits\Plugins\AcceptsJson;

class UnsplashConnector extends SaloonConnector
{
    use AcceptsJson;
    use RequiresAuth;

    /**
     * The Base URL of the API.
     *
     * @return string
     */
    public function defineBaseUrl(): string
    {
        return 'https://api.unsplash.com';
    }

   public function defaultAuth(): ?AuthenticatorInterface
   {
       return new UnsplashAuthenticator(config('services.unsplash.client-id'));
   }
}
