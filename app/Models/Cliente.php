<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'endereco', 'telefone'];

    public function encomendas()
    {
        return $this->hasMany(Encomenda::class);
    }
}

?>
