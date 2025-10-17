<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prato extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'preco_unitario'];

    public function ingredientes()
    {
        return $this->belongsToMany(Ingrediente::class)->withPivot('quantidade');
    }

    public function encomendas()
    {
        return $this->belongsToMany(Encomenda::class)->withPivot('quantidade');
    }
}

?>
