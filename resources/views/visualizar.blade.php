<?php
	$imgName = asset('/uploads/itens-images/' . $_GET['img']);
?>
<html >
	<head>
		<title>Visualiozação de imagem</title>
		<script src="{{ asset('js/bootstrap.min.js') }}"></script>
		<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">	
		<link rel="stylesheet" type="text/css" href="{{ asset('css/css-visualizar.css') }}">		
		
	</head>
	<body>		
		<a href="/"><button>Voltar</button></a>
		<img src="{{$imgName}}" alt="Smiley face">
	</body>
</html>