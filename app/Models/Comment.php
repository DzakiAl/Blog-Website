<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    
    public function blog()
    {
        return $this->belongsTo(Blog::class, 'post_id'); // Use 'post_id' as the foreign key
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
