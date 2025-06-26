<?php
namespace App\Models;

use App\Models\FormTarget;
use App\Models\FormKategori;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $guarded = ['id'];

    public function kategori()
    {
        return $this->hasMany(FormKategori::class);
    }
    public function pengisi()
    {
        return $this->hasOne(FormPengisi::class);
    }
    public function target()
    {
        return $this->hasOne(FormTarget::class);
    }
}
