<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    protected $fillable = ['nota_fiscal', 'data_compra', 'quantidade', 'fornecedor_id', 'ingrediente_id'];

    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class);
    }

    public function ingrediente()
    {
        return $this->belongsTo(Ingrediente::class);
    }
}

?>
