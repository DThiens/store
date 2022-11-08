<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class group extends Model
{
    use HasFactory;
    protected $table = 'groups';

    public function getAll()
    {
        $group = DB::table($this->table)->get();
        return $group;
    }
}
