<?php

class UserController
{
	public function actionRegister()
	{

		$name = '';
		$email = '';
		$password = '';

		if(isset($_POST['submit']))
		{
			$name = $_POST['name'];
			$email = $_POST['email'];
			$password = $_POST['password'];
			
			$errors = false;

			if(!User::checkName($name)){
				$errors[] = 'Ошибка, Имя должно быть не короче 2-х символов';
			}

			if(!User::checkPassword($password)) {
				$errors[] = 'Ошибка, Пароль должен быть не короче 6 символов';
			}

			if(!User::checkEmail($email)) {
				$errors[] = 'Ошибка, Не правильный email';
			}

			if(User::checkEmailExists($email)) {
				$errors[] = 'Ошибка, Такой email уже существует';
			}

			if($errors == false)
			{
				$result = User::register($name, $email, $password);
			}
		}


		require_once (ROOT . '/views/user/register.php');

		return true;
	}

	public function actionLogin()
	{
		$email = '';
		$password = '';

		if(isset($_POST['submit'])) {
			$email = $_POST['email'];
			$password = $_POST['password'];

			$errors = false;

			//Валидация полей
			if(User::checkEmail($email)) {
				$errors[] = 'Ошибка, Не верный email';
			}

			if(User::checkPassword($password)) {
				$errors[] = 'Ошибка, пароль должен состоять минимум из 6 символов';
			}

			//Проверяем существует ли пользователь
			$userId = User::checkUserData($email, $password);

			if($userId == false) {
				//Если данные не верные - показываем ошибку
				$errors[] = 'Ошибка входа на сайт Введенные данные неправильные!';
			} else {
				//Если данные правильные, запоминаем пользователя (сессия)
				User::auth($userId);

				//Перенаправляем пользователя в закрытую часть (cabinet)
				header("Location: /cabinet/");
			}

		}

		require_once ROOT . '/views/user/login.php';

		return true;
	}


	/*
	*Удаляем данные о пользователе из сессии
	*/
	public function actionLogout()
	{
		unset($_SESSION['user']);
		header("Location: /");
	}
}