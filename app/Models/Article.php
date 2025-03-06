<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Assurez-vous d'importer ce trait
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Article extends Model
{
    use HasFactory; // Utiliser le trait HasFactory pour les usines de modèles

    // Si tu souhaites définir les colonnes autorisées pour l'assignation de masse
    protected $fillable = ['titre', 'description', 'context', 'instruction', 'image'];
}
class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = ['pseudo', 'email', 'password', 'avatar'];
}