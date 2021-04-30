<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    use HasFactory;

     protected $table = 'messages';

    protected $fillable = [
        'content',
        'send_by',
        'send_to',
        'read_at'
    ];

    // Relationships
    public function users()
    {
        return $this->belongsTo(User::class, 'send_by');
    }
}
