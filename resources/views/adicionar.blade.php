<!DOCTYPE html>
<html ng-app="addApp" ng-controller="addController">
	<head>
		<title>Adicionar Item</title>
		<script src="{{ asset('js/angular.min.js') }}"></script>
		<script src="{{ asset('js/bootstrap.min.js') }}"></script>
		<script src="{{ asset('js/jsUtils.js') }}"></script>
		<script src="{{ asset('js/adicionar-app.js') }}"></script>
		
		<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('css/css-adicionar.css') }}">		
	</head>
	<body>		
		<div class="col-6">			
			<div class="form-group col-4">
				<div class="row">
					<label for="nome">Nome</label>
					<input type="text" placeholder="Nome" class="form-control" name="nome" ng-model="nome"/>
				</div>
				<div class="row">
					<label for="descricao">Descrição</label>
					<textarea class="form-control" placeholder="Descrição" ng-model="descricao" name="descricao"></textarea>
				</div>
				<div class="row">
					<label for="vlCompra">Valor de compra</label>
					<input type="text" onkeypress="onlyNumbers(event)" placeholder="Valor de compra. Ex: 123.45" class="form-control" name="vlCompra" ng-model="vlCompra"/>
				</div>
				<div class="row">
					<label for="vlRevenda">Valor de revenda</label>
					<input type="text" onkeypress="onlyNumbers(event)" placeholder="Valor de revenda. Ex: 123.45" class="form-control" name="vlRevenda" ng-model="vlRevenda"/>
				</div>				
				<div class="row">
					<label for="image">Imagem</label>
					<input type="file" class="form-control" name="image" onchange="angular.element(this).scope().getImageFile(this)" accept="image/*">			
				</div>
				<div class="row">
					<input type="checkbox" ng-model="ativo" name="ativo"/> <span class="ativo-span"> Ativo</span>
				</div>
			</div>
			<div class="col-4">
				<div class="row">
					<button class="btn btn-primary btn-add" ng-click="adicionaItem()">@{{btnText}}</button>
					<button class="btn btn-secondary btn-back" ng-click="backToIndex()">Voltar</button>		
				</div>
			</div>
		</div>
	</body>
</html>