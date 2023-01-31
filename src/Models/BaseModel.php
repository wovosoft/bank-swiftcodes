<?php

namespace Wovosoft\BankSwiftcodes\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Wovosoft\LaravelCommon\Traits\HasTablePrefix;

class BaseModel extends Model
{
    use HasFactory;
    use HasTablePrefix;

    public function __construct(array $attributes = [])
    {
        $this->connection = config("bank-swiftcodes.database.connection");
        parent::__construct($attributes);
    }

    public function getPrefix(): string
    {
        return config("bank-swiftcodes.table.prefix");
    }
}
