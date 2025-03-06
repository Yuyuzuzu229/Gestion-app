<?php

namespace App\Http\Controllers;

use App\Models\Article; // Assure-toi d'importer le modèle Article
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Importer la classe Storage

class ArticleController extends Controller
{
    // Affiche la page de création d'article
    public function create()
    {
        return view('articles.create');
    }

    // Affiche la liste des articles
    public function index()
    {
        $articles = Article::all();
        return view('articles.liste', compact('articles'));
    }

    // Enregistre un nouvel article
    public function store(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'titre' => 'required|string|max:255', // Le titre est requis
            'description' => 'required|string',
            'context' => 'required|string',
            'instruction' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        // Enregistrement de l'article dans la base de données
        $article = new Article();
        $article->titre = $validated['titre'];
        $article->description = $validated['description'];
        $article->context = $validated['context'];
        $article->instruction = $validated['instruction'];
    
        // Gestion de l'image (si elle existe)
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('articles', 'public');
            $article->image = $imagePath;
        }
    
        $article->save();
    
        // Redirection vers la page de liste des articles avec un message de succès
        return redirect()->route('articles.index')->with('success', 'Article créé avec succès !');
    }

    // Affiche les détails d'un article
    public function show($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.show', compact('article'));
    }

    // Affiche le formulaire d'édition d'un article
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.edit', compact('article')); // Assure-toi que la vue `edit` existe
    }

    // Met à jour un article existant
    public function update(Request $request, $id)
    {
        // Validation des données
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'context' => 'required|string',
            'instruction' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        // Trouver l'article
        $article = Article::findOrFail($id);

        // Gestion de l'image (si elle existe)
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($article->image) {
                Storage::delete('public/' . $article->image);
            }
            
            // Sauvegarder la nouvelle image
            $imagePath = $request->file('image')->store('articles', 'public');
            $article->image = $imagePath;
        }
    
        // Mise à jour des champs
        $article->titre = $validated['titre'];
        $article->description = $validated['description'];
        $article->context = $validated['context'];
        $article->instruction = $validated['instruction'];
    
        $article->save();
    
        // Redirection vers la page de liste des articles
        return redirect()->route('articles.index')->with('success', 'Article mis à jour avec succès !');
    }

    // Méthode pour générer le PDF (à définir selon tes besoins)
    public function generatePDF($id)
    {
        $article = Article::findOrFail($id);

        // Ici, tu devras utiliser une bibliothèque comme `dompdf` ou `barryvdh/laravel-dompdf`
        // pour générer un PDF à partir des données de l'article.
    }
}
