<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $table = 'types';

    // Funzione per specificare la relazione con la tabella Projects
    public function projects() {
        return $this->hasMany(Project::class);
    }

}
