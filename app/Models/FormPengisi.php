<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormPengisi extends Model
{
    protected $guarded = ['id'];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class,'jabatan_id');
    }
}
