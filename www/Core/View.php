<?php 

namespace App\Core;

class View
{
	private $template;
	private $view;
	private $data = [];

	public function __construct ($view, $template="front") {
		$this->setTemplate($template);
		$this->setView($view, $template);
	}

	//objectif : debug
	//Afficher les information de la vue pour comprendre ce qu'il y a dedans
    public function __toString(){
    	$msg = "Le template c'est : ".$this->template."<br>";
    	$msg .= "La vue c'est : ".$this->view."<br>";
    	$msg .= "Voici les données  : ".serialize($this->data)."<br>";

    	return $msg;
    }



	public function setTemplate($template){
		//Ici nous n'aurons que front ou back
		if( file_exists("Views/Templates/" . $template . ".tpl.php")) {
			$this->template = "Views/Templates/" . $template . ".tpl.php";
		}else{
			die("Le template ".$template." n'existe pas ");
		}
	}

	public function setView($view){
		
		//exemple View/Security/login.view.php
		if( file_exists("Views/Security/".$view.".view.php")){
			$this->view = "Views/Security/".$view.".view.php";
		}else{
			die("La vue ".$view." n'existe pas ");
		}
	}

	public function assign($key, $value)
	{
		$this->data[$key] = $value;
	}




	public function __destruct(){
		extract($this->data);
		include $this->template;
	}

}