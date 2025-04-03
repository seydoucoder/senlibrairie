<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Book;

class Commande extends Model
{
    protected $table = 'commandes';

    protected $fillable = [
        'dateCommande',
        'statut',
        'montantTotal',
        'client_id'
    ];

    protected $casts = [
        'dateCommande' => 'datetime',
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function livres()
    {
        return $this->belongsToMany(Book::class, 'commande_livre', 'commande_id', 'livre_id')
                    ->withPivot('quantite', 'prix_unitaire')
                    ->withTimestamps();
    }

    public function paiement()
    {
        return $this->hasOne(Paiement::class, 'commande_id');
    }
}