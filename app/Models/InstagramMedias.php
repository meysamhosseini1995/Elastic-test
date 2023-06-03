<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstagramMedias extends Model
{
    use HasFactory;

    protected $fillable = [
        "instagram_id",
        "type",
        "media_link",
    ];
}
