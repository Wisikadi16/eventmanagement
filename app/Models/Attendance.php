<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'event_id', // Jika Anda mengelola beberapa event
        'checked_in_at',
        'scanned_by', // User ID staff yang melakukan scan
        'barcode_data', // Data barcode yang di-scan (misalnya, user_id)
    ];

    protected $casts = [
        'checked_in_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
