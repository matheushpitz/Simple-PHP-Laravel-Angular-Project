<?php
	$imgName = asset('/uploads/itens-images/' . $_GET['img']);
?>
<!DOCTYPE html>
<html >
	<head>
		<title>Visualiozação de imagem</title>
		<script src="{{ asset('js/bootstrap.min.js') }}"></script>
		<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">	
		<link rel="stylesheet" type="text/css" href="{{ asset('css/css-visualizar.css') }}">		
		
	</head>
	<body>		
		<div class="col-12">
			<div class="row">
				<img src="{{$imgName}}" alt="Smiley face">
			</div>
			<div class="row">
				<a href="/"><button class="btn btn-secondary btn-back">Voltar</button></a>
			</div>
		</div>
	</body>
</html>