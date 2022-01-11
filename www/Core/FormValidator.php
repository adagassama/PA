<?php

namespace App\Core;

class FormValidator
{
	
	public static function check($form, $data){
		$errors = [];

			foreach ($form["inputs"] as $name => $configInput) {
				
				if(!empty($configInput["minLength"]) &&
					is_numeric($configInput["minLength"]) &&
					strlen($data[$name]) < $configInput["minLength"]
					){
					$errors[] = $configInput["error"];
				}

			}

		return $errors;
	}


}