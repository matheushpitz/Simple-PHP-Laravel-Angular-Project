<html ng-app="addApp" ng-controller="addController">
	<head>
		<title>Adicionar Item</title>
		<script src="{{ asset('js/angular.min.js') }}"></script>
		
		<script>
			var app = angular.module('addApp', []);
			app.controller('addController', function($scope, $http) {	
			
				// Função para voltar ao index.
				$scope.backToIndex = function(page) {
					window.location.href = 'http://phplaravel.test/';
				};
				
			});
		</script>
		
	</head>
	<body>		
		<h1>Add item</h1>
	</body>
</html>