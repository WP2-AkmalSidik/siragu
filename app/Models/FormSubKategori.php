<?php
namespace App\Models;

use App\Models\FormPenilaian;
use Illuminate\Database\Eloquent\Model;

class FormSubKategori extends Model
{
    protected $guarded = ['id'];

    public function kategori()
    {
        return $this->belongsTo(FormKategori::class);
    }

    public function penilaian()
    {
        return $this->hasMany(FormPenilaian::class);
    }
}
