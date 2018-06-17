<html ng-app="addApp" ng-controller="addController">
	<head>
		<title>Adicionar Item</title>
		<script src="{{ asset('js/angular.min.js') }}"></script>
		
		<script>
			var app = angular.module('addApp', []);
			app.controller('addController', function($scope, $http) {	
			
				$scope.nome = '';
				$scope.descricao = '';
				$scope.vlCompra = '';
				$scope.vlRevenda = '';
				$scope.ativo = false;
				$scope.img = null;
			
				// Função para voltar ao index.
				$scope.backToIndex = function(page) {
					window.location.href = 'http://phplaravel.test/';
				};
				
				$scope.getImageFile = function(image) {
					$scope.img = image;
					alert(image.files[0]);
				};
				
				$scope.adicionaItem = function() {
					var data = new FormData();
					data.append('name', $scope.nome);
					data.append('desc', $scope.descricao);
					data.append('vlC', $scope.vlCompra);
					data.append('vlR', $scope.vlRevenda);
					data.append('ativo', $scope.ativo);
					data.append('image', $scope.img.files[0]);
					$http({
						url: 'http://phplaravel.test/addItem',
						method: 'POST',
						data: data,
						headers: {'Content-Type': undefined }
					}).then(function(response) {
						alert(JSON.stringify(response));
					});
				}
				
			});
		</script>
		
	</head>
	<body>		
		<form class="form-inline" name="formItem">
			Nome: <input type="text" ng-model="nome"/>
			Descrição: <textarea ng-model="descricao"></textarea>
			Valor de compra: <input type="text" ng-model="vlCompra"/>
			Valor de revenda: <input type="text" ng-model="vlRevenda"/>
			<input type="checkbox" ng-model="ativo"/> Ativo
			Imagem: <input type="file" onchange="angular.element(this).scope().getImageFile(this)" accept="image/*">
			<img src="@{{img}}" width="100" height="50" alt="Image preview...">
			<button ng-click="adicionaItem()">Adicionar</button>
			<button ng-click="backToIndex()">Cancelar</button>
		</form>
	</body>
</html>