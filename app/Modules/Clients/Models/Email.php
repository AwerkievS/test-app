<?php

namespace App\Modules\Clients\Models;

use Database\Factories\EmailFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Email extends Model
{

    use HasFactory;

    protected $fillable = [
        'email'
    ];

    public static function newFactory(): EmailFactory
    {
        return EmailFactory::new();
    }

    protected function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

}
