<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingrediente extends Model
{
    use HasFactory;

    protected $fillable = ['nome'];

    public function pratos()
    {
        return $this->belongsToMany(Prato::class)->withPivot('quantidade');
    }

    public function compras()
    {
        return $this->hasMany(Compra::class);
    }
}

?>
