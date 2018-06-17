<html ng-app="indexApp" ng-controller="indexController">
	<head>
		<title>Laravel project</title>
		<script src="{{ asset('js/angular.min.js') }}"></script>
		
		<script>
			var app = angular.module('indexApp', []);
			app.controller('indexController', function($scope, $http) {
				
				// Pega os dados do server
				$http({
					url: 'http://phplaravel.test/getItens',
					method: 'GET'
				}).then(function(response) {
					$scope.data = response.data;
				});
				
				// Função para redirecionar.
				$scope.openPage = function(page) {
					window.location.href = 'http://phplaravel.test/'+page;
				};
			});
		</script>
		
	</head>
	<body>		
		<button ng-click = "openPage('adicionar')">Adicionar Item</button>
		<table border="1px">
			<tr>
				<th>ID</th>
				<th>Nome</th>
				<th>Descrição</th>
				<th>Valor Compra</th>
				<th>Valor Revenda</th>
				<th>Ativo</th>
				<th>Imagem</th>
			</tr>
			<tr ng-repeat="d in data">
				<td>@{{d.id}}</td>
				<td>@{{d.nome}}</td>
				<td>@{{d.descricao}}</td>
				<td>@{{d.vlCompra}}</td>
				<td>@{{d.vlRevenda}}</td>
				<td>@{{d.ativo}}</td>
				<td><a href = "/visualizar?img=@{{d.imagem}}">Visualizar</a></td>
			</tr>
		</table>
	</body>
</html>