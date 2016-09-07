//var root      = root_url;
var root 		= "http://www.jobfair.ba/";

var jflanding = angular.module('jfApp', ['ngRoute']);
$(document).ready(function(){ $("a.grouped-elements").fancybox(); });

function reload_naslovna(){
	window.location = root;
}

jflanding.config(function($routeProvider, $locationProvider){
		$routeProvider
			.when('/',{
					templateUrl: 'partials/home.php'
			})
			.when('/oeestecu',{
					templateUrl: 'partials/oeestecu-full.php',
					controller	: 'oeestecu'
			})
			.when('/ojobfairu',{
					templateUrl: 'partials/ojobfairu-full.php',
					controller : 'ojobfairu'
			})
			.when('/ucesnici',{
					templateUrl: 'partials/partneri-full.php',
					controller : 'ucesnici'
			})
            .when('/mediji',{
					templateUrl: 'partials/mediji-full.php',
					controller : 'mediji'
			})
            .when('/suorganizatori',{
					templateUrl: 'partials/suorganizatori-full.php',
					controller : 'suorganizatori'
			})

			.when('/galerije',{
					templateUrl: 'partials/gallery-full.php',
					templateUrl: 'partials/login-full.php',
					controller : 'login'
					controller : 'galerija'
			})
			.when('/login',{
			})
			.when('/kontakt',{
					templateUrl: 'partials/contact-full.php',
					controller : 'kontakt'
			})
			.when('/novosti',{
					templateUrl: 'partials/vijesti-full.php',
					controller : 'novosti'
			})
			.when('/postani-partner',{
					templateUrl: 'partials/postani-partner-full.php',
					controller : 'postani_partner'
			})
			.otherwise({redirectTo:'/'});
});

jflanding.factory('Page', function(){
  var title 		= 'JobFAIR.ba | Iskoristi svoju šansu';
  var description 	= 'JobFAIR - Sajam zapošljavanja za studente i diplomce tehničko-tehnoloških fakulteta i ekonomije';
  var image 		= root + 'img/social-media/og.jpg';
  var url 			= root;

  return {
    title: 			function() { return title; },
    description: 	function(){ return description; },
    image: 			function(){ return image; },
    url: 			function(){ return ulr; },

    setTitle: 		function(newTitle) { title = newTitle; },
    setDescription: function(newDes){ description = newDes; },
    setImage: 		function(newImg){ image = newImg; },
    setUrl: 		function(newUrl){ url = newUrl; }
  };
});

/* Title and og regulacija */
jflanding.controller('oeestecu', 		function ($scope, Page) { Page.setTitle('JobFAIR | O EESTEC-u'); });
jflanding.controller('ojobfairu', 		function ($scope, Page) { Page.setTitle('JobFAIR | O JobFAIR-u'); });
jflanding.controller('ucesnici', 		function ($scope, Page) { Page.setTitle('JobFAIR | Učesnici'); });
jflanding.controller('mediji', 		   function ($scope, Page) { Page.setTitle('JobFAIR | Mediji'); });
jflanding.controller('suorganizatori',  function ($scope, Page) { Page.setTitle('JobFAIR | Suorganizatori'); });
jflanding.controller('galerija', 		function ($scope, Page) { Page.setTitle('JobFAIR | Galerije'); });
jflanding.controller('login', 			function ($scope, Page) { Page.setTitle('JobFAIR | Login za studente'); });
jflanding.controller('kontakt', 		function ($scope, Page) { Page.setTitle('JobFAIR | Kontakt'); });
jflanding.controller('novosti', 		function ($scope, Page) { Page.setTitle('JobFAIR | Novosti'); });
jflanding.controller('postani_partner', function ($scope, Page) { Page.setTitle('JobFAIR | Postani partner'); });

jflanding.controller('ucitajNovost', function($scope, $routeParams, $http, Page){
	$scope.novost_id = $routeParams.param1;
	$scope.Page = Page;
	var id =  $scope.novost_id;
	$http.get(root + "jfapi.php?stream=novost&id="+id).success(function(res){
		$scope.novost = res[0];

		// Og set
		Page.setTitle(res[0].naslov);
		Page.setDescription(res[0].opis);
		Page.setImage(res[0].velika_slika);
		Page.setUrl(root + '#/novost/' + res[0].id);
	});
});

jflanding.controller('naslovnaControler', function($scope, $http){
	$scope.page = 1;

	$http.get(root + "jfapi.php?stream=items").success(function(res){
		$scope.ukupno = res;
	});

	$http.get(root + "jfapi.php?stream=naslovna&strana=" + $scope.page).success(function(res){
		$scope.ns = res;
	});

	$scope.loadMore = function() {
    $scope.page++;
		$http.get(root + "jfapi.php?stream=naslovna&strana=" + $scope.page).success(function(res){
			$scope.ns = $scope.ns.concat(res);
		});
	if($scope.page == $scope.ukupno) $('.btn-show-more').remove();
  };

	$scope.nextPageDisabledClass = function() {
    return $scope.page === $scope.ukupno ? "disabled" : "";
  };
});

jflanding.controller('galerijaControler', function($scope, $http){
	$scope.page = 1;

	$http.get(root + "jfapi.php?stream=items_gal").success(function(res){
		$scope.ukupno = res;
	});

	$http.get(root + "jfapi.php?stream=galerije&strana=" + $scope.page).success(function(res){
		$scope.gal = res;
	});

	$scope.loadMore = function() {
    $scope.page++;
		$http.get(root + "jfapi.php?stream=galerije&strana=" + $scope.page).success(function(res){
			$scope.gal = $scope.gal.concat(res);
		});
	if($scope.page == $scope.ukupno) $('.btn-show-more').remove();
  };

	$scope.nextPageDisabledClass = function() {
    return $scope.page === $scope.ukupno ? "disabled" : "";
  };
});
