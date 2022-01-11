<?php 

namespace App\Controllers;

use App\Core\View;
use App\Models\User;
use App\Core\FormValidator;
use App\Core\Mailing;
use App\Core\Helpers;

class SecurityController
{

	public function registerAction()
	{

		
		$userRegister = new User();

		$view = new View("register");

		$form = $userRegister->formRegister();

		if (!empty($_POST)) {

			$errors = FormValidator::check($form, $_POST);

			if (empty($errors)) {

				 $mailExists = $userRegister->verifyMail($_POST['email'], $userRegister->getTable());
				 # verify unicity in database


				 if ($mailExists == 0) {

					if ($_POST['pwd'] == $_POST['pwdConfirm']) {

						$pwd = password_hash($_POST['pwd'], PASSWORD_DEFAULT);

						$userRegister->setFirstname(htmlspecialchars($_POST["firstname"]));
						$userRegister->setLastname(Helpers::clearLastname($_POST["lastname"]));
						$userRegister->setEmail(htmlspecialchars($_POST["email"]));
						$userRegister->setPwd($pwd);
						$userRegister->save();
						Mailing::sendMail($_POST["email"]);


					}else{
						echo 'Votre mot de mot de passe de confirmation ne correspond pas';
					}
				} else{
					echo 'Ce Mail existe déjà';
				}
			} else {
				echo 'Champ incorrect ';
				
			}
		}

		$view->assign("form", $form);
	}

	
	
}




