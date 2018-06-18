// Cria o app
var app = angular.module('indexApp', []);
// Cria o controller
app.controller('indexController', function($scope, $http) {
	var control = $scope;

	// Método refreshData.
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
			// Salva a resposta
			control.data = response.data;
		});
	};				
	
	// Função para redirecionar.
	control.openPage = function(page) {					
		window.location.href = '/'+page;
	};
	// Função para remover o item
	control.removeItem = function(id) {
		// Exibe um confirm dialog.
		if( confirm('Tem certeza que deseja excluir o item com ID = '+id) ) {
			// faz a requisição.
			$http({
				url: '/removeItem',
				method: 'POST',
				data: {id: id}
			}).then(function(response) {
				// Verifica se retornou erro.
				if(response.data.error == undefined) {
					// Atualiza
					control.refreshData();
					alert('Item deletado com sucesso');
				} else {
					alert('Erro ao deletar o item');
				}
			});
		}
	};
	// Chama a página de edição de item.
	control.editItem = function(id) {					
		control.openPage('adicionar?id='+id);
	};
	// Inicializa as váriveis de filtro.
	control.initFiltro = function() {
		control.filtroNome = '';
		control.filtroMinVlC = '';
		control.filtroMaxVlC = '';
		control.filtroMinVlR = '';
		control.filtroMaxVlR = '';
		control.filtroAtivo = '';
	};
	// Init.
	control.initFiltro();
	control.refreshData();				
	
});