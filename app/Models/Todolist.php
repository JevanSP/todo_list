<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Todolist extends Model
{

    protected $table = 'todolist';

    protected $fillable =
    [
        'nama',
        'status',
        'prioritas',
        'tgl_ditambahkan',
        'tgl_ditandai',
    ];

}
