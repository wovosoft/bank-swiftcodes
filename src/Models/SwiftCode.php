<?php

namespace Wovosoft\BankSwiftcodes\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SwiftCode extends BaseModel
{
    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class);
    }
}
