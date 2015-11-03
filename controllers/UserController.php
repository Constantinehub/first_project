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
			
		}


		require_once (ROOT . '/views/user/register.php');

		return true;
	}
}