<?php
namespace App\Models;

use App\Models\Jabatan;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class JabatanUser extends Model
{
    protected $guarded = ['id'];
    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
