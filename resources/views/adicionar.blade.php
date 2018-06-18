<!DOCTYPE html>
<html ng-app="addApp" ng-controller="addController">
	<head>
		<title>Adicionar Item</title>
		<script src="{{ asset('js/angular.min.js') }}"></script>
		<script src="{{ asset('js/bootstrap.min.js') }}"></script>
		<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('css/css-adicionar.css') }}">
		
		<script>
			function getAllUrlParams(url) {

			  // get query string from url (optional) or window
			  var queryString = url ? url.split('?')[1] : window.location.search.slice(1);

			  // we'll store the parameters here
			  var obj = {};

			  // if query string exists
			  if (queryString) {

				// stuff after # is not part of query string, so get rid of it
				queryString = queryString.split('#')[0];

				// split our query string into its component parts
				var arr = queryString.split('&');

				for (var i=0; i<arr.length; i++) {
				  // separate the keys and the values
				  var a = arr[i].split('=');

				  // in case params look like: list[]=thing1&list[]=thing2
				  var paramNum = undefined;
				  var paramName = a[0].replace(/\[\d*\]/, function(v) {
					paramNum = v.slice(1,-1);
					return '';
				  });

				  // set parameter value (use 'true' if empty)
				  var paramValue = typeof(a[1])==='undefined' ? true : a[1];

				  // (optional) keep case consistent
				  paramName = paramName.toLowerCase();
				  paramValue = paramValue.toLowerCase();

				  // if parameter name already exists
				  if (obj[paramName]) {
					// convert value to array (if still string)
					if (typeof obj[paramName] === 'string') {
					  obj[paramName] = [obj[paramName]];
					}
					// if no array index number specified...
					if (typeof paramNum === 'undefined') {
					  // put the value on the end of the array
					  obj[paramName].push(paramValue);
					}
					// if array index number specified...
					else {
					  // put the value at that index number
					  obj[paramName][paramNum] = paramValue;
					}
				  }
				  // if param name doesn't exist yet, set it
				  else {
					obj[paramName] = paramValue;
				  }
				}
			  }

			  return obj;
			}

		</script>
		
		<script>
			var app = angular.module('addApp', []);
			app.controller('addController', function($scope, $http) {								
				var control = $scope;								
				
				// Função para voltar ao index.
				control.backToIndex = function(page) {
					window.location.href = '/';
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
				control.initValues = function(nome, desc, vlC, vlR, ativo, img) {
					control.nome = nome;
					control.descricao = desc;
					control.vlCompra = vlC;
					control.vlRevenda = vlR;
					control.ativo = ativo == 1;
					control.img = img;
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
					if(control.isUpdating == true)
						data.append('id', urlParam['id']);
					$http({
						url: '/addItem',
						method: 'POST',
						data: data,
						headers: {'Content-Type': undefined }
					}).then(function(response) {
						if(response.data.error != undefined) {
							alert('Ocorreu um erro ao cadastrar no servidor.');
						} else {
							if(control.isUpdating) {
								alert('Item atualizado com sucesso');
								control.backToIndex();
							} else {
								alert('Item cadastrado com sucesso.');
								control.clearValues();
							}
						}
					});
				}
				
				control.clearValues();
				control.btnText = 'Adicionar';
				
				var urlParam = getAllUrlParams(window.location.href);
				if(urlParam['id'] != undefined) {
					control.isUpdating = true;
					control.btnText = 'Atualizar';
					$http({
						url: '/getItens?id='+urlParam['id'],
						method: 'GET'
					}).then(function(response) {
						var data = response.data[0];
						control.initValues(data['nome'], data['descricao'], data['vlCompra'], data['vlRevenda'], data['ativo'], data['imagem']);
					});
				}
				
			});
		</script>
		
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
					<input type="text" placeholder="Valor de compra. Ex: 123.45" class="form-control" name="vlCompra" ng-model="vlCompra"/>
				</div>
				<div class="row">
					<label for="vlRevenda">Valor de revenda</label>
					<input type="text" placeholder="Valor de revenda. Ex: 123.45" class="form-control" name="vlRevenda" ng-model="vlRevenda"/>
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