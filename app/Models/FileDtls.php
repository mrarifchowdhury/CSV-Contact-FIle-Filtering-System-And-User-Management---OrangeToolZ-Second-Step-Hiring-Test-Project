<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FileDtls extends Model
{
    protected $table = "file_details";
    protected $fillable = [
        'number', 'first_name','last_name','email', 'state', 'zip', 'file_id', 'group_id'				
    ];
}
