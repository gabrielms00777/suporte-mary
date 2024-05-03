<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Unlock extends Model
{
    use HasFactory;

    protected $fillable = [
        'rep_id',
        'responsible',
        'emergency',
        'observation',
        'created_by',
        'amount',
    ];

    protected $casts = [
        'emergency' => 'boolean'
    ];

    public function rep(): BelongsTo
    {
        return $this->belongsTo(Rep::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
