<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    protected $table = 'paiements';

    protected $fillable = [
        'commande_id',
        'montant',
        'datePaiement',
        'modePaiement'
    ];

    protected $casts = [
        'datePaiement' => 'datetime'
    ];

    public function commande()
    {
        return $this->belongsTo(Commande::class, 'commande_id');
    }
}