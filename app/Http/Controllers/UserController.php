<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', '!=', 'gestionnaire')->get();
        return view('users.index', compact('users'));
    }

    public function destroy(User $user)
    {
        if ($user->role !== 'gestionnaire') {
            $user->delete();
            return redirect()->route('users.index')->with('success', 'Utilisateur supprimé avec succès');
        }
        return redirect()->route('users.index')->with('error', 'Action non autorisée');
    }
}