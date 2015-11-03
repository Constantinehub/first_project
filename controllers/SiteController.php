<?php

class SiteController
{

	public function actionIndex()
	{
		$categories = array();
		$categories = Category::getCategoriesList(); //getting method category 

		$latestProduct = array();
		$latestProduct = Product::getLatestProduct(6);

		require_once(ROOT . '/views/site/index.php');

		return true;
	}

}