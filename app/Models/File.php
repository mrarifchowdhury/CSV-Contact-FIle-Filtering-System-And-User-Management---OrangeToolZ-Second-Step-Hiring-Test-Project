<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = "files";
    protected $fillable = [
        'file_name', 'original_name','total_uploaded','total_process', 'user_id'				
    ];
}
