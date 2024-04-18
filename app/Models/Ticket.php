<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'client_name',
        'client_phone',
        'created_by',
        'reported_issue',
        'status',
        'solution',
        'observation',
        'finished_at',
        'finished_by',
        'scheduling_date'
    ];

    protected $casts = [
        'finished_at' => 'datetime',
        'scheduling_date' => 'datetime',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function finishedBy()
    {
        return $this->belongsTo(User::class, 'finished_by');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
