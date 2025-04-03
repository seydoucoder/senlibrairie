<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            [
                'titre' => 'L\'Art de la Guerre',
                'auteur' => 'Sun Tzu',
                'description' => 'Un traité de stratégie militaire chinois datant du VIe siècle av. J.-C.',
                'prix' => 12000,
                'quantite' => 50,
                'category_id' => 3, // Histoire
                'est_populaire' => true,
                'est_nouveau' => false,
            ],
            [
                'titre' => 'Les Misérables',
                'auteur' => 'Victor Hugo',
                'description' => 'Un chef-d\'œuvre de la littérature française qui suit Jean Valjean dans sa quête de rédemption.',
                'prix' => 15000,
                'quantite' => 30,
                'category_id' => 1, // Romans
                'est_populaire' => true,
                'est_nouveau' => false,
            ],
            [
                'titre' => 'Le Petit Prince',
                'auteur' => 'Antoine de Saint-Exupéry',
                'description' => 'Une histoire poétique qui aborde les thèmes de l\'amour, l\'amitié et le sens de la vie.',
                'prix' => 10000,
                'quantite' => 45,
                'category_id' => 6, // Jeunesse
                'est_populaire' => true,
                'est_nouveau' => true,
            ],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}