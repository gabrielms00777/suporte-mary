<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_name',
        'contact_person',
        'address',
        'postal_code',
        'number',
        'city',
        'complement',
        'cpf_cnpj',
        'phone1',
        'phone2',
        'status',
        'contract',
        'system',
        'created_by',
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
