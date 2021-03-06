<?php

namespace App\Core;

use PDO;

class Singleton
{

	# private static $instance = null;
	protected static $pdo = null; # jamais manipule hors objet, pas de get
	# static pour ne pas dependre de l'objet je pense

	private function __construct()
	{
	}

	public function getPDO()
	{
		if (is_null(self::$pdo)) {
			#self::$instance = new Singleton();
			try {
				self::$pdo = new PDO("mysql:host=database;dbname=mvcdocker2;port=3306", "root", "password");

				self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				self::$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

			} catch (\Exception $e) {
				die("Erreur SQL " . $e->getMessage());
			}
		}
		return self::$pdo;
	}


	public function save()
	{

		$columns = array_diff_key(
			get_object_vars($this),
			get_class_vars(get_class())
		);

		//INSERT OU UPDATE
		if (is_null($this->getId())) {
			//INSERT
			$query = "INSERT INTO " . $this->getTable() . " (" .
				implode(",", array_keys($columns))
				. ") 
				VALUES ( :" .
				implode(",:", array_keys($columns))
				. " )";
		} else {

			//UPDATE
			$query = "UPDATE " . strtolower(($this->getTable())) . " SET ";
			foreach ($columns as $key => $value) {
				$query .= $key . "=:" . $key . ",";
			}
			$query = substr($query, 0, -1); # retire la dernière virgule
			$query .= " WHERE id=" . $this->getId();
		}

		$result = $this->getPDO()->prepare($query)->execute($columns);
		echo "Utilisateur enregistré <br><br>";
	}

}
