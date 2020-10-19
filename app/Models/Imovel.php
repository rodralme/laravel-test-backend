<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Imovel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'imoveis';

    protected $fillable = [
        'email_proprietario', 'rua', 'numero', 'complemento', 'bairro', 'cidade', 'estado',
    ];

    public function contrato()
    {
        return $this->hasOne(Contrato::class, 'imovel_id');
    }

    public function getReferenciaAttribute()
    {
        return collect([
            $this->rua,
            $this->numero,
            $this->cidade,
            $this->estado,
        ])->filter(fn($item) => !empty($item))
            ->join(', ');
    }

    public function getStatusAttribute()
    {
        // todo implementar
        return false;
    }
}
