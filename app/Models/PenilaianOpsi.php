<?php
namespace App\Models;

use App\Models\PenilaianTipe;
use Illuminate\Database\Eloquent\Model;

class PenilaianOpsi extends Model
{
    protected $guarded = ['id'];

    public function tipe()
    {
        return $this->belongsTo(PenilaianTipe::class, 'penilaian_tipe_id');
    }
}
