<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $guarded = ['id'];

    public function pengisi()
    {
        return $this->belongsTo(User::class, 'pengisi');
    }

    public function target()
    {
        return $this->belongsTo(User::class, 'target');
    }
}
