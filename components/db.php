<?php

class db
{
	public static function getConnection()
	{
		$paramsPath = ROOT . '/config/db_params.php';
		$params = include($paramsPath);

		// $opt = array(
		// 	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		// 	PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);

		$db = new PDO("mysql:dbname={$params['dbname']};host={$params['host']}", $params['user'], $params['password']);
		$db->exec("set names utf8");

		return $db;
	}
}