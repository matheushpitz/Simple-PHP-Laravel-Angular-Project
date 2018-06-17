<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
	// VIEW
	public function index() {
		return view('index');
	}
	
	public function adicionar() {
		return view('adicionar');
	}
	
	public function visualizar() {
		return view('visualizar');
	}
	
	// REST
	public function addItem() {
				
		DB::table('item')->insert(['nome' => 'item1', 'descricao' => 'descricao teste', 'vlCompra' => 1280.82, 'vlRevenda' => 1378.583, 'ativo' => true, 'imagem' => 'diretorio de teste']);
		
		return view('welcome');
	}
	
	public function getItens() {
		return DB::table('item')->get();
	}
}
