<html ng-app="indexApp" ng-controller="indexController">
	<head>
		<title>Laravel project</title>
		<script src="{{ asset('js/angular.min.js') }}"></script>
		<script src="{{ asset('js/bootstrap.min.js') }}"></script>
		<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('css/css-index.css') }}">
		
		<script>
			var app = angular.module('indexApp', []);
			app.controller('indexController', function($scope, $http) {
				var control = $scope;
				
				control.refreshData = function() {
					// Pega os dados do server
					$http({
						url: '/getItens',
							
						method: 'GET',
						params: {
							name: control.filtroNome,
							minVlC: control.filtroMinVlC,
							maxVlC: control.filtroMaxVlC,
							minVlR: control.filtroMinVlR,
							maxVlR: control.filtroMaxVlR,
							ativo: control.filtroAtivo
						}
					}).then(function(response) {
						control.data = response.data;
					});
				};				
				
				// Função para redirecionar.
				control.openPage = function(page) {					
					window.location.href = '/'+page;
				};
				
				control.removeItem = function(id) {
					if( confirm('Tem certeza que deseja excluir o item com ID = '+id) ) {
						$http({
							url: '/removeItem',
							method: 'POST',
							data: {id: id}
						}).then(function(response) {
							if(response.data.error == undefined) {
								control.refreshData();
								alert('Item deletado com sucesso');
							} else {
								alert('Erro ao deletar o item');
							}
						});
					}
				};
				
				control.editItem = function(id) {					
					control.openPage('adicionar?id='+id);
				};
				
				control.initFiltro = function() {
					control.filtroNome = '';
					control.filtroMinVlC = '';
					control.filtroMaxVlC = '';
					control.filtroMinVlR = '';
					control.filtroMaxVlR = '';
					control.filtroAtivo = '';
				};
				
				control.initFiltro();
				control.refreshData();				
				
			});
		</script>
		
	</head>
	<body>
		<div class="col-12">
			<div class="col-3">
				<div class="row">
					<button class="btn btn-primary" ng-click = "openPage('adicionar')">Adicionar Item</button>
				</div>
			</div>
			
			<div class="col-6">
				<div class="row">
					Nome: <input type="text" ng-model="filtroNome" />
				</div>
				<div class="row">
					Valor Compra: <input type="text" ng-model="filtroMinVlC" /> <input type="text" ng-model="filtroMaxVlC" />
				</div>
				<div class="row">
					Valor Revenda: <input type="text" ng-model="filtroMinVlR" /> <input type="text" ng-model="filtroMaxVlR" />
				</div>
				<div class="row">
					<input type="checkbox" ng-model="filtroAtivo" /> Ativo
				</div>
				<div class="row">
					<button class="btn btn-secondary" ng-click="refreshData()">Filtrar</button>
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