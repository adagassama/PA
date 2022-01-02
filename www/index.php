<?php

namespace App;

spl_autoload_register("App\myAutoloader");



function myAutoloader($class) {
	// Tentatitve d'instance de App\Core\View
	// App\Core\View -> App/Core/View
	$class = str_replace("\\", "/", $class);
	// App/Core/View -> Core/View
	$class = str_ireplace("App/", "", $class);
	// Core/View -> Core/View.php
	$class .= ".php";
	if(file_exists($class)){
		include $class;
	}

}

?>


<?php
//Je dois récupérer ici pour commencer l'url de l'internaute
$uri = $_SERVER["REQUEST_URI"];

//PARSER le ficher YAML
$listOfRoutes = yaml_parse_file("routes.yml");

//Si la route dans le ficheir YAML n'existe pas
//alors on récupère les informations pour la route 404
$route = $listOfRoutes[$uri]??$listOfRoutes["/404"];

$controller = $route["controller"];
$action = $route["action"];


//Est-ce que le fichier controller existe
if(file_exists("Controllers/".$controller.".php")) {
	include "Controllers/".$controller.".php";

	//Est-ce que la class existe
	$controllerWithNP = "App\\Controllers\\".$controller;


	
	if( class_exists($controllerWithNP) ) {
		$cObject = new $controllerWithNP();
		//Est-ce que la méthode existe 
		if(method_exists($cObject, $action)){
			$cObject->$action();
		} else {
			die("La methode ".$action." n'existe pas");
		}
	}else{
		die("La class ".$controllerWithNP." n'existe pas");
	}

} else {
	die("Le fichier Controllers/".$controller.".php n'existe pas");
}





