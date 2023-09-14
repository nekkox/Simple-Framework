<?php

namespace Tests\Dataproviders;

class RouterDataProvider
{
    public static function routeNotFoundCasesClass(): array
    {
        return [
            ['/users', 'put'], //route is found but request method is not found
            ['/invoices', 'post'],
            ['/users', 'get'], // fails because Users is not a class
            ['/notes', 'get'],
            // ['/notes','post'],
            ['/forms', 'get'], //still fails because Forms is not a class
        ];
    }

}