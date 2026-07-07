<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $guarded = ["kode_role"];
    protected $table = 'tb_role';
    protected $primaryKey = 'kode_role';
    protected $fillable = ['nama_role'];

    public function users()
    {
        return $this->hasMany(User::class, 'kode_role', 'kode_role');
    }
}
