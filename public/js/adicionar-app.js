// Cria o app
var app = angular.module('addApp', []);
// Cria o controller.
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
	// Inicializa os inputs com os valores passados por parametro.
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
		// Cria o FormData.
		var data = new FormData();
		data.append('name', control.nome);
		data.append('desc', control.descricao);
		data.append('vlC', control.vlCompra);
		data.append('vlR', control.vlRevenda);
		data.append('ativo', control.ativo);
		data.append('image', control.img);
		// Verifica se está atualizando
		if(control.isUpdating == true)
			data.append('id', urlParam['id']);
		// Manda a requisição.
		$http({
			url: '/insertUpdateItem',
			method: 'POST',
			data: data,
			headers: {'Content-Type': undefined }
		}).then(function(response) {
			// Verifica se ocorreu erro.
			if(response.data.error != undefined) {
				alert('Ocorreu um erro ao cadastrar no servidor.');
			} else {
				// Verifica se está atualizando.
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
	// Limpa as variaveis.
	control.clearValues();
	// Adiciona o texto padrão do botão.
	control.btnText = 'Adicionar';
	
	// Verifica se existe o parametro id na requisição.
	var urlParam = getAllUrlParams(window.location.href);
	if(urlParam['id'] != undefined) {
		// Está atualizando um item.
		control.isUpdating = true;
		// Muda o texto padrão do botão.
		control.btnText = 'Atualizar';
		// Faz a requisição para pegar os valores atuais.
		$http({
			url: '/getItens?id='+urlParam['id'],
			method: 'GET'
		}).then(function(response) {
			var data = response.data[0];
			control.initValues(data['nome'], data['descricao'], data['vlCompra'], data['vlRevenda'], data['ativo'], data['imagem']);
		});
	}
	
});