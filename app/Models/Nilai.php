<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $guarded = ['id'];

    public function pengisi()
    {
        return $this->belongsTo(User::class, 'pengisi_id');
    }

    public function target()
    {
        return $this->belongsTo(User::class, 'target_id');
    }

    public function penilaian()
    {
        return $this->belongsTo(FormPenilaian::class, 'form_penilaian_id');
    }
}
