<?php

namespace App\Exceptions;

use Exception;

class PaginatorOutOfBoundException extends Exception
{
    public function report()
    {
    }

    public function render($request)
    {
        $currentUrl = url()->current();
        $queryString = http_build_query(array_merge($request->all(), [
            'page' => $request->get('page', 2) - 1,
        ]));

        return redirect("{$currentUrl}?{$queryString}");
    }
}
