<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Image;

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
		if ($request->hasFile('img')) {
            $image      = $request->file('img');
            $fileName   = time() . '.' . $image->getClientOriginalExtension();

            $img = Image::make($image->getRealPath());
            $img->resize(120, 120, function ($constraint) {
                $constraint->aspectRatio();                 
            });

            $img->stream(); // <-- Key point

            //dd();
            Storage::disk('local')->put('images/1/smalls'.'/'.$fileName, $img, 'public');
}	
		
		return $request->post();
		$data = $request->post();
		$response = array();
		if($data != null) {
			if($data['name'] != null && $data['desc'] != null && $data['vlC'] != null && $data['vlR'] != null && $data['ativo'] != null) {
				DB::table('item')->insert(['nome' => $data['name'], 'descricao' => $data['desc'], 'vlCompra' => $data['vlC'], 'vlRevenda' => $data['vlR'], 'ativo' => $data['ativo'], 'imagem' => 'diretorio de teste']);
			} else {
				$response['error'] = 1;
			}
		} else {
			$response['error'] = 1;
		}				
				
		return $response;
	}
	
	public function getItens() {
		return DB::table('item')->get();
	}
}
