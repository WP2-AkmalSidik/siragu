<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $guarded = ['id'];

    public function pengisi()
    {
        return $this->hasMany(FormPengisi::class);
    }
    public function target()
    {
        return $this->hasMany(FormTarget::class);
    }
}
