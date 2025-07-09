<?php
namespace App\Models;

use App\Models\FormKategori;
use App\Models\FormPenilaian;
use App\Models\FormTarget;
use App\Models\Nilai;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $guarded = ['id'];

    public function kategori()
    {
        return $this->hasMany(FormKategori::class);
    }
    public function pengisi()
    {
        return $this->hasOne(FormPengisi::class);
    }
    public function target()
    {
        return $this->hasOne(FormTarget::class);
    }
    public function penilaian()
    {
        return $this->hasMany(FormPenilaian::class);
    }

    public function tipe()
    {
        return $this->belongsTo(PenilaianTipe::class, 'penilaian_tipe_id');
    }

    public function nilai()
    {
        return $this->hasManyThrough(
            Nilai::class,
            FormPenilaian::class,
            'form_id',           // Foreign key on form_penilaians table
            'form_penilaian_id', // Foreign key on nilais table
            'id',                // Local key on forms table
            'id'                 // Local key on form_penilaians table
        );
    }

    public function getStrukturLengkap()
    {
        $struktur = [
            'id'                 => $this->id,
            'nama'               => $this->nama,
            'keterangan'         => $this->keterangan,
            'penilaian_langsung' => $this->penilaianLangsung()->get(),
            'kategori'           => [],
        ];

        foreach ($this->kategori as $kategori) {
            $kategoriData = [
                'id'                 => $kategori->id,
                'nama'               => $kategori->kategori,
                'penilaian_langsung' => $kategori->penilaianLangsung()->get(),
                'sub_kategori'       => [],
            ];

            foreach ($kategori->sub as $sk) {
                $subKategoriData = [
                    'id'         => $sk->id,
                    'nama'       => $sk->sub_kategori,
                    'penilaians' => $sk->penilaians()->get(),
                ];

                $kategoriData['sub_kategori'][] = $subKategoriData;
            }

            $struktur['kategori'][] = $kategoriData;
        }

        return $struktur;
    }
    public function penilaianLangsung()
    {
        return $this->penilaian()
            ->whereNull('form_kategori_id')
            ->whereNull('form_sub_kategori_id');
    }
}
