angular.module("app_usuarios",[])
	.controller("ctrl_perfil", function($scope,$http){
			$scope.user_datos="pepe";
			/*$http.get('http://jsonplaceholder.typicode.com/posts')
			.then(function(data){
				console.log(data);
			});
			$http.get('ajax/ajax_usuarios2.php')
			.then(function(response){
				//console.log(response);
				//$scope.usuario=response.data;
			});*/
			$http.post('ajax/ajax_usuarios2.php',{op: 'listar'})
			.then(function(response){
				console.log(response);
				$("#respuesta").html(response.data);
				$scope.usuario=response.data;
			});

			/* $http({
              
	              method: 'POST',
	              
	              url:  'ajax/ajax_usuarios.php',
	              data: { op: 'listar' }
	              
	          }).then(function (response) {
	        
	              console.log(response);
	        
	          }, function (response) {
	              
	              console.log(response.data,response.status);
	              
	          });*/
	        
	});