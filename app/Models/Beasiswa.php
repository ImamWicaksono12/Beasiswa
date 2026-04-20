<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Beasiswa extends Model
{
    use HasFactory;

    protected $table = 'beasiswa';

    protected $fillable = [
        'nama_beasiswa',
        'sumber_dana',
        'nominal',
        'kategori_dana',
        'link_pendaftaran_luar',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'nominal'   => 'integer',
    ];

    /**
     * Label kategori dana yang lebih mudah dibaca.
     */
    public function getKategoriLabelAttribute(): string
    {
        return match ($this->kategori_dana) {
            'fully_funded'     => 'Fully Funded',
            'partially_funded' => 'Partially Funded',
            'one_shoot'        => 'One Shoot',
            default            => ucfirst($this->kategori_dana),
        };
    }

    /**
     * Nominal dalam format Rupiah.
     */
    public function getNominalRupiahAttribute(): string
    {
        return 'Rp ' . number_format($this->nominal, 0, ',', '.');
    }
}
