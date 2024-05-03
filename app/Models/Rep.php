<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rep extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'serial_number',
        'amount',
    ];

    public function unlocks(): HasMany
    {
        return $this->hasMany(Unlock::class);
    }
}
