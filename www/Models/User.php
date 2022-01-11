<?php

namespace App\Models;

use App\Core\Singleton;
use PDO;


class User extends Singleton
{

    protected $id = null;

    protected $firstname;
    protected $lastname;
    protected $email;
    protected $pwd;

    private $table =  "gkvw0_user";

    //Il s'agit d'une surcharge du constructeur Parent
    public function __construct()
    {
        
    }


    public function getTable()
    {
        return $this->table;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param null $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {

        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPwd()
    {
        return $this->pwd;
    }

    /**
     * @param mixed $pwd
     */
    public function setPwd($pwd)
    {
        $this->pwd = $pwd;
    }


    public function formRegister()
    {
        return [

            "config" => [
                "method" => "POST",
                "action" => "",
                "id" => "form_register",
                "class" => "form_builder",
                "submit" => "S'inscrire"
            ],
            "inputs" => [
                "firstname" => [
                    "type" => "text",
                    "label" => "Votre prénom",
                    "minLength" => 2,
                    "maxLength" => 55,
                    "id" => "firstname",
                    "class" => "form_input",
                    "placeholder" => "Exemple: Adama",
                    "value" => '',
                    "error" => "Votre prénom doit faire entre 2 et 55 caractères",
                    "required" => true
                ],
                "lastname" => [
                    "type" => "text",
                    "label" => "Votre nom",
                    "minLength" => 2,
                    "maxLength" => 255,
                    "id" => "lastname",
                    "class" => "form_input",
                    "placeholder" => "Exemple: GASSAMA",
                    "value" => '',
                    "error" => "",
                    "required" => true
                ],
                "email" => [
                    "type" => "email",
                    "label" => "Votre email",
                    "minLength" => 8,
                    "maxLength" => 320,
                    "id" => "email",
                    "class" => "form_input",
                    "placeholder" => "Exemple: nom@gmail.com",
                    "value" => '',
                    "error" => "",
                    "required" => true
                ],
                "pwd" => [
                    "type" => "password",
                    "label" => "Votre mot de passe",
                    "minLength" => 8,
                    "id" => "pwd",
                    "class" => "form_input",
                    "placeholder" => "Mot de passe",
                    "error" => "",
                    "required" => true
                ],
                "pwdConfirm" => [
                    "type" => "password",
                    "label" => "Confirmation du mot de passe",
                    "confirm" => "pwd",
                    "id" => "pwdConfirm",
                    "class" => "form_input",
                    "placeholder" => "Confirmation du mot de passe",
                    "error" => "",
                    "required" => true
                ]
            ]

        ];
    }

    # verifie que le mail existe en base
    public function verifyMail($email)
    {


        $query = "SELECT COUNT(*) FROM " . $this->table . " WHERE email = '" . $email . "'";
        $prepare = $this->getPDO()->prepare($query);
        $prepare->execute();
        $count = $prepare->fetchColumn();

        switch ($count) {
            case 0:
                return 0; # le mail n'existe pas : go pour inscription, ko pour la connexion
                break;
            case 1:
                return 1; # le mail existe en un exemplaire : go pour la connexion
                break;

            default:
                echo "ERREUR VERIFY MAIL";
                return 2; # erreur bizarre              
                break;
        }
    }
    
}