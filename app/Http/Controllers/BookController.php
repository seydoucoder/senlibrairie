<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::query();
        
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('titre', 'LIKE', "%{$search}%")
                  ->orWhere('auteur', 'LIKE', "%{$search}%");
            });
        }
        
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }
        
        $books = $query->get();
        $categories = Category::all();
        
        return view('books.index', compact('books', 'categories'));
    }

    public function manage()
    {
        $books = Book::with('category')->orderBy('created_at', 'desc')->get();
        return view('admin.books.manage', compact('books'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|max:255',
            'auteur' => 'required|max:255',
            'description' => 'required',
            'prix' => 'required|numeric|min:0',
            'quantite' => 'required|integer|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'category_id' => 'required|exists:categories,id',
            'est_populaire' => 'boolean'
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images/books'), $imageName);
            $validated['image'] = '/images/books/' . $imageName;
        }

        Book::create($validated);

        return redirect()->route('books.manage')->with('success', 'Livre ajouté avec succès');
    }

    public function edit(Book $book)
    {
        $categories = Category::all();
        return view('books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'titre' => 'required|max:255',
            'auteur' => 'required|max:255',
            'description' => 'required',
            'prix' => 'required|numeric|min:0',
            'quantite' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'category_id' => 'required|exists:categories,id'
        ]);

       
        $validated['est_populaire'] = $request->has('est_populaire') ? true : false;

        if ($request->hasFile('image')) {
           
            if ($book->image && file_exists(public_path($book->image))) {
                unlink(public_path($book->image));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images/books'), $imageName);
            $validated['image'] = '/images/books/' . $imageName;
        }

        try {
            $book->update($validated);
            return redirect()->route('books.manage')->with('success', 'Livre mis à jour avec succès');
        } catch (\Exception $e) {
            return back()->with('error', 'Erreur lors de la mise à jour: ' . $e->getMessage());
        }
    }

    public function destroy(Book $book)
    {
        if ($book->image && file_exists(public_path($book->image))) {
            unlink(public_path($book->image));
        }
        
        $book->delete();
        
        return redirect()->route('books.manage')->with('success', 'Livre supprimé avec succès');
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }
}