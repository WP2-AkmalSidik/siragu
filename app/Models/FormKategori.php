<?php
namespace App\Models;

use App\Models\FormPenilaian;
use Illuminate\Database\Eloquent\Model;

class FormKategori extends Model
{
    protected $guarded = ['id'];

    public function forms()
    {
        return $this->belongsTo(Form::class);
    }
    public function subKategori()
    {
        return $this->hasMany(FormSubKategori::class);
    }

    public function penilaian()
    {
        return $this->hasMany(FormPenilaian::class);
    }
}
