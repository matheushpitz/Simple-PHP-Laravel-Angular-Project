<?php
	$imgName = asset('/uploads/itens-images/' . $_GET['img']);
?>
<html >
	<head>
		<title>Visualiozação de imagem</title>						
		
	</head>
	<body>		
		<a href="http://phplaravel.test"><button>Voltar</button></a>
		<img src="{{$imgName}}" alt="Smiley face">
	</body>
</html>