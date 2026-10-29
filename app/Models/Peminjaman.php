<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjamans'; // Memberi tahu Laravel nama tabel yang benar
    protected $guarded = []; 
}