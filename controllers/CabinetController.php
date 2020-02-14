<?php 
class CabinetController {

	public function actionIndex() {

		$userId = User::checkLogged();

		$user = User::getUserById($userId);

		require_once (ROOT.'/view/cabinet/index.php');

		return true;
	}

	public function actionEdit() {

		$userId = User::checkLogged();

		$user = User::getUserById($userId);
		
		$name = $user['name'];
		$password = $user['password'];

		$result = false;

		if (isset($_POST['submit'])) {
			$name = $_POST['name'];
			$password = $_POST['password'];

			$errors = false;

			if (!User::checkName($name)) {
				$errors[] = 'Имя не должно быть короче 2-х символов';
			}

			if (!User::checkPassword($password)) {
				$errors[] = 'Пароль не должен быть короче 6-х символов.';
			}

			if ($errors == false) {
				$result = User::edit($userId, $name, $password);
			}
		}

		require_once (ROOT.'/view/cabinet/edit.php');

		return true;
	}
}
?>