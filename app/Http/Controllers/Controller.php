<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Image;
use Illuminate\Support\Facades\Storage;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
	// VIEW
	
	/**
		View index
	**/
	public function index() {
		return view('index');
	}
	
	/**
		View adicionar
	**/
	public function adicionar() {
		return view('adicionar');
	}
	
	/**
		View visualizar
	**/
	public function visualizar() {
		return view('visualizar');
	}
	
	// REST
	
	/**
		Responsável pela inserção e atualização dos itens.
	**/
	public function insertUpdateItem(Request $request) {													
		$data = $request->post();				
		
		$response = array();
		// verifica se os dados são nulos.
		if($data != null) {		
			// Verifica os parametros
			if( ($data['name'] != null || $data['name'] === '') && ($data['desc'] != null || $data['desc'] === '') && 
				($data['vlC'] != null || $data['vlC'] === '') && ($data['vlR'] != null || $data['vlR'] === '') && 
				($data['ativo'] != null || $data['ativo'] === '') ) {
					
				$fileName = '';
				// Verifica se tem imagem.
				if($request->hasFile('image')) {
					// Pega a imagem
					$image = $request->file('image');
					// gera o nome da imagem.
					$fileName = time() . '-' . str_replace(' ', '', $data['name']) . '.' . $image->getClientOriginalExtension();

					$auxImage = Image::make($image->getRealPath());
					// Redimensiona a imagem para não ficar muito grande
					$auxImage->resize(512, 512, function ($constraint) {
						$constraint->aspectRatio();                 
					});
					// Chama o método stream.
					$auxImage->stream();
					// Salva a imagem
					Storage::disk('uploads')->put('itens-images'.'/'.$fileName, $auxImage, 'public');										
				} else {
					// se não tiver pega o nome do arquivo.
					$fileName = $data['image'];
				}
				// Verifica se tem id, pois, se tiver isso é um update e não inserção.
				if($request->has('id')) {	
					// Atualiza os dados.
					DB::table('item')->where('id', '=', $data['id'])->update(['nome' => $data['name'], 'descricao' => $data['desc'], 'vlCompra' => $data['vlC'], 'vlRevenda' => $data['vlR'], 'ativo' => $data['ativo'] == 'true' ? 1 : 0, 'imagem' => $fileName]);
				} else {
					// Adiciona novos dados.
					DB::table('item')->insert(['nome' => $data['name'], 'descricao' => $data['desc'], 'vlCompra' => $data['vlC'], 'vlRevenda' => $data['vlR'], 'ativo' => $data['ativo'] == 'true' ? 1 : 0, 'imagem' => $fileName]);
				}
			} else {
				$response['error'] = 1;
			}
		} else {
			$response['error'] = 1;
		}				
				
		
		return $response;
	}
	
	/**
		Responsável pela remoção dos itens.
	**/
	public function removeItem(Request $request) {
		$response = array();
		$data = $request->post();
		if($data['id'] != null && $data['id'] != '') {
			DB::table('item')->where('id', '=', $data['id'])->delete();			
		} else {
			$response['error'] = 1;
		}
		return $response;
	}
	
	/**
		Responsável pelo retorno dos itens no Banco de dados.
	**/
	public function getItens(Request $request) {
		// Filtros
		$id = $request->get('id');	
		$nome = $request->get('name');
		$minVlC = $request->get('minVlC');
		$maxVlC = $request->get('maxVlC');
		$minVlR = $request->get('minVlR');
		$maxVlR = $request->get('maxVlR');
		$ativo = $request->get('ativo');			
		
		$sqlWhere = array();
		
		// Verifica os filtros
		if($id != null && $id != '')
			array_push($sqlWhere, ['id', '=', $id]);
		
		if($nome != null && $nome != '')
			array_push($sqlWhere, ['nome', 'like', '%'.$nome.'%']);
		
		if($minVlC != null && $minVlC != '')
			array_push($sqlWhere, ['vlCompra', '>=', $minVlC]);
		
		if($maxVlC != null && $maxVlC != '')
			array_push($sqlWhere, ['vlCompra', '<=', $maxVlC]);
		
		if($minVlR != null && $minVlR != '')
			array_push($sqlWhere, ['vlRevenda', '>=', $minVlR]);
		
		if($maxVlR != null && $maxVlR != '')
			array_push($sqlWhere, ['vlRevenda', '<=', $maxVlR]);
		
		if($ativo != null && $ativo != '')
			array_push($sqlWhere, ['ativo', '=', ($ativo == 'true' ? 1 : 0)]);
		
		// select.
		return DB::table('item')->where($sqlWhere)->get();		
	}
}
