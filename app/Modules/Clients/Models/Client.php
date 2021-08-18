<?php

namespace App\Modules\Clients\Models;

use Database\Factories\ClientFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Client extends Model
{

    use HasFactory;

    protected $fillable = [
        'name',
        'last_name',
    ];

    public static function newFactory(): ClientFactory
    {
        return ClientFactory::new();
    }

    public function emails(): HasMany
    {
        return $this->hasMany(Email::class);
    }

    public function phones(): HasMany
    {
        return $this->hasMany(Phone::class);
    }

}
