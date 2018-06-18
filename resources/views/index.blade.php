<!DOCTYPE html>
<html ng-app="indexApp" ng-controller="indexController">
	<head>
		<title>Laravel project</title>
		<script src="{{ asset('js/angular.min.js') }}"></script>
		<script src="{{ asset('js/bootstrap.min.js') }}"></script>
		<script src="{{ asset('js/index-app.js') }}"></script>
		<script src="{{ asset('js/jsUtils.js') }}"></script>
		
		<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('css/css-index.css') }}">						
	</head>
	<body>
		<div class="col-12">							
			<div class="col-2 form-group">								
				<div class="row">
					<label for="nome">Nome</label>
					<input type="text" placeholder="Nome" name="nome" class="form-control" ng-model="filtroNome" />
				</div>
				<div class="row">
					<label for="vlCompra">Valor compra</label>
					<input type="text" onkeypress="onlyNumbers(event)" placeholder="Min. Ex: 123.45" name="vlCompra" class="form-control" ng-model="filtroMinVlC" />
					<input type="text" onkeypress="onlyNumbers(event)" placeholder="Max. Ex: 123.45" class="form-control" ng-model="filtroMaxVlC" />
				</div>
				<div class="row">
					<label for="vlRevenda">Valor revenda</label>
					<input type="text" onkeypress="onlyNumbers(event)" placeholder="Min. Ex: 123.45" name="vlRevenda" class="form-control" ng-model="filtroMinVlR" />
					<input type="text" onkeypress="onlyNumbers(event)" placeholder="Max. Ex: 123.45" class="form-control" ng-model="filtroMaxVlR" />
				</div>
				<div class="row">
					<input type="checkbox" ng-model="filtroAtivo" /> <span class="ativo-span">Ativo</span>
				</div>
				<div class="row">
					<button class="btn btn-secondary" ng-click="refreshData()">Filtrar</button>
				</div>			
			</div>
			<div class="col-3">
				<div class="row">
					<button class="btn btn-primary" ng-click = "openPage('adicionar')">Adicionar Item</button>
				</div>
			</div>
			
			<div class="col-12">
				<div class="row">
					<table class="table table-striped">
						<tr>
							<th>ID</th>
							<th>Nome</th>
							<th>Descrição</th>
							<th>Valor Compra</th>
							<th>Valor Revenda</th>
							<th>Ativo</th>
							<th>Imagem</th>
							<th>Editar</th>
							<th>Excluir</th>
						</tr>
						<tr ng-repeat="d in data">
							<td>@{{d.id}}</td>
							<td>@{{d.nome}}</td>
							<td>@{{d.descricao}}</td>
							<td>@{{d.vlCompra}}</td>
							<td>@{{d.vlRevenda}}</td>
							<td>@{{d.ativo}}</td>
							<td><a href = "/visualizar?img=@{{d.imagem}}">Visualizar</a></td>
							<td><a href="#" ng-click="editItem(d.id)">Editar</a></td>
							<td><a href="#" ng-click="removeItem(d.id)">Excluir</a></td>
						</tr>
					</table>
				</div>
			</div>
		</body>
	</div>
</html>