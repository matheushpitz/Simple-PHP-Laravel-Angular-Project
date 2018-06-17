<html ng-app="addApp" ng-controller="addController">
	<head>
		<title>Adicionar Item</title>
		<script src="{{ asset('js/angular.min.js') }}"></script>
		
		<script>
			var app = angular.module('addApp', []);
			app.controller('addController', function($scope, $http) {								
				var control = $scope;
				
				// Função para voltar ao index.
				control.backToIndex = function(page) {
					window.location.href = 'http://phplaravel.test/';
				};
				// Função para carregar a imagem do type
				control.getImageFile = function(image) {
					control.img = image.files[0];					
				};
				// Limpa os valores das váriaveis.
				control.clearValues = function() {
					control.ativo = false;
					control.nome = '';
					control.descricao = '';
					control.vlCompra = '';
					control.vlRevenda = '';
					control.img = null;
				};
				// Ação adicionar item
				control.adicionaItem = function() {
					
					// Verificações
					if(control.nome == undefined || control.name === '') {
						alert('Campo nome não pode ser vazio');
						return;
					}
					if(control.descricao == undefined || control.desc === '') {
						alert('O campo descrição não pode ser vazio.');
						return;
					}
					if(control.vlCompra == undefined || control.vlCompra === '') {
						alert('O valor de compra não pode ser vazio');
						return;
					}
					if(control.vlRevenda == undefined || control.vlRevenda === '') {						
						alert('O valor de revenda não pode ser vazio');
						return;
					}
					if(control.img == undefined || control.img == null) {
						alert('É preciso adicionar uma imagem');
						return;
					}
					
					var data = new FormData();
					data.append('name', control.nome);
					data.append('desc', control.descricao);
					data.append('vlC', control.vlCompra);
					data.append('vlR', control.vlRevenda);
					data.append('ativo', control.ativo);
					data.append('image', control.img);
					$http({
						url: 'http://phplaravel.test/addItem',
						method: 'POST',
						data: data,
						headers: {'Content-Type': undefined }
					}).then(function(response) {
						if(response.data.error != undefined) {
							alert('Ocorreu um erro ao cadastrar no servidor.');
						} else {
							alert('Item cadastrado com sucesso.');
							control.clearValues();
						}
					});
				}
				
				control.clearValues();
				
			});
		</script>
		
	</head>
	<body>		
		<form class="form-inline" name="formItem">
			Nome: <input type="text" name="nome" ng-model="nome"/>
			Descrição: <textarea ng-model="descricao" name="descricao"></textarea>
			Valor de compra: <input type="text" name="vlCompra" ng-model="vlCompra"/>
			Valor de revenda: <input type="text" name="vlRevenda" ng-model="vlRevenda"/>
			<input type="checkbox" ng-model="ativo" name="ativo"/> Ativo
			Imagem: <input type="file" name="image" onchange="angular.element(this).scope().getImageFile(this)" accept="image/*">			
			<button ng-click="adicionaItem()">Adicionar</button>
			<button ng-click="backToIndex()">Voltar</button>
		</form>
	</body>
</html>