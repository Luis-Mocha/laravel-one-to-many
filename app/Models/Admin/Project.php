<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// importo helper per la mia funzione
use Illuminate\Support\Str;


class Project extends Model
{
    use HasFactory;


    // funzione custom
    public static function generateSlug($title)
    {
        return Str::slug($title, '-');
    }


    protected $table = 'projects';

    protected $fillable = [
        'title',
        'slug',
        'description',
        'cover_img',
        'link_project',
    ];

    // Funzione per specificare la relazione con la tabella Types
    public function type() {
        return $this->belongsTo(Type::class);
    }

}
