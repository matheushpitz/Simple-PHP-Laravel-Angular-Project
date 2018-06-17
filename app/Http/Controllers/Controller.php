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
	public function addItem(Request $request) {													
		$data = $request->post();				
		
		$response = array();
		if($data != null) {		
			// Verifica os parametros
			if( ($data['name'] != null || $data['name'] === '') && ($data['desc'] != null || $data['desc'] === '') && 
				($data['vlC'] != null || $data['vlC'] === '') && ($data['vlR'] != null || $data['vlR'] === '') && 
				($data['ativo'] != null || $data['ativo'] === '') && ($request->hasFile('image')) ) {
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
				
				DB::table('item')->insert(['nome' => $data['name'], 'descricao' => $data['desc'], 'vlCompra' => $data['vlC'], 'vlRevenda' => $data['vlR'], 'ativo' => $data['ativo'] == 'true' ? 1 : 0, 'imagem' => $fileName]);
			} else {
				$response['error'] = 1;
			}
		} else {
			$response['error'] = 1;
		}				
				
		
		return $response;
	}
	
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
	
	public function getItens() {
		return DB::table('item')->get();
	}
}
