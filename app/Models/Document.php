<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
         protected $fillable = [
        'title', 'file_path', 'file_name', 'mime_type', 'size', 'order', 'is_active'
    ];
}
