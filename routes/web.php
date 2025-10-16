<?php

use Illuminate\Support\Facades\Route;
use App\Models\Produtos;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/produtos', function () {
    return view('produtos');
});


/*Route::get('/produtos/cadastrar', function (Request $request) {
    $produtos = new Produtos();   
    $produtos->nome = $request->formNomeProduto;
    $produtos->gravar($request->formNomeProduto,$request->formFornecedorProduto);

    return view('produtos',["dado"=> $request->formNomeProduto]);
});
*/

 

Route::post('/produtos/cadastrar', function(Request $request) {
    $produtos = new Produtos();   
    $produtos->gravar($request->formNomeProduto,$request->formFornecedorProduto);
    return view('produtos',["dado"=> "dados passados via post"]);
});



Route::get('/user/{id}', function (string $id) {
    return 'User '.$id;
});


Route::get('/cardapio', function () {
        $produtos = new Produtos();   
        $produtos= $produtos->listarProdutos();         
    return view('pratos',["listaProdutos"=>$produtos]);
});
