<?php
namespace App\Models;

use App\Models\PenilaianOpsi;
use Illuminate\Database\Eloquent\Model;

class PenilaianTipe extends Model
{
    protected $guarded = ['id'];

    public function opsi()
    {
        return $this->hasMany(PenilaianOpsi::class);
    }
}
