<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormSubKategori extends Model
{
    protected $guarded = ['id'];

    public function kategori()
    {
        return $this->belongsTo(FormKategori::class);
    }
}
