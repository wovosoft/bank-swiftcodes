<?php

namespace Wovosoft\BankSwiftcodes\Facades;

use Illuminate\Support\Facades\Facade;

class BankSwiftcodes extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'bank-swiftcodes';
    }
}
