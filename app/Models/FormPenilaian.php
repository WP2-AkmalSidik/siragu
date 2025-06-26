<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormPenilaian extends Model
{
    protected $guarded = ['id'];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
    public function subKategori()
    {
        return $this->belongsTo(FormSubKategori::class);
    }
    public function kategori()
    {
        return $this->belongsTo(FormKategori::class);
    }
}
