<html ng-app="indexApp" ng-controller="indexController">
	<head>
		<title>Laravel project</title>
		<script src="{{ asset('js/angular.min.js') }}"></script>
		
		<script>
			var app = angular.module('indexApp', []);
			app.controller('indexController', function($scope, $http) {
				var control = $scope;
				
				control.refreshData = function() {
					// Pega os dados do server
					$http({
						url: 'http://phplaravel.test/getItens',
						method: 'GET'
					}).then(function(response) {
						control.data = response.data;
					});
				};				
				
				// Função para redirecionar.
				control.openPage = function(page) {
					window.location.href = 'http://phplaravel.test/'+page;
				};
				
				control.removeItem = function(id) {
					if( confirm('Tem certeza que deseja excluir o item com ID = '+id) ) {
						$http({
							url: 'http://phplaravel.test/removeItem',
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
				
				control.refreshData();
				
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
				<td><a href="#" ng-click="removeItem(d.id)">Editar</a></td>
				<td><a href="#" ng-click="removeItem(d.id)">Excluir</a></td>
			</tr>
		</table>
	</body>
</html>