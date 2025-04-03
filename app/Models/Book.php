<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'titre',
        'auteur',
        'description',
        'prix',
        'quantite',
        'image',
        'category_id',
        'est_populaire'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function getImageUrlAttribute()
    {
        return asset($this->image);
    }

    public function commandes()
    {
        return $this->belongsToMany(Commande::class, 'commande_livre', 'livre_id', 'commande_id')
                    ->withPivot('quantite', 'prix_unitaire')
                    ->withTimestamps();
    }
}