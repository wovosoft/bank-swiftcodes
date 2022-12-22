<?php

namespace Wovosoft\BankSwiftcodes\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Wovosoft\LaravelCommon\Traits\HasTablePrefix;

class SwiftCode extends Model
{
    use HasFactory;
    use HasTablePrefix;

    public function getPrefix(): string
    {
        return config("bank-swiftcodes.table.prefix");
    }

    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class);
    }
}
