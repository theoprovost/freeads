<?php

namespace App\Models;


use App\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ads extends Model
{
    use HasFactory;

    protected $table = 'ads';

    protected $fillable = [
        'title',
        'description',
        'photograph',
        'price',
        'category_id'
    ];

    // Relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function media()
    {
        return $this->hasMany(Media::class);
    }

    public function categories()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
}
