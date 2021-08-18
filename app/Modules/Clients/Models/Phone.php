<?php

namespace App\Modules\Clients\Models;

use Database\Factories\PhoneFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Phone extends Model
{

    use HasFactory;

    protected $table = 'client_phones';

    protected $fillable = [
        'phone',
    ];

    public static function newFactory(): PhoneFactory
    {
        return PhoneFactory::new();
    }

    protected function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

}
