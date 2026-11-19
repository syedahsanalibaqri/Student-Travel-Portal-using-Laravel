<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TravelRegistration extends Model
{
    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'department',
        'destination',
        'status',
        'medical_notes',
    ];

    // Local query scope for filtering
    public function scopeFilter($query, $search)
    {
        if ($search) {
            $query->where('full_name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('destination', 'LIKE', "%{$search}%");
        }
    }
}
