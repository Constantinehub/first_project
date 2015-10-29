<?php

include_once ROOT . '/models/Category.php';
include_once ROOT . '/models/Product.php';

class SiteController
{

	public function actionIndex()
	{
		$categories = array();
		$categories = Category::getCategoriesList(); //getting method category 

		$latestProduct = array();
		$latestProduct = Product::getLatestProduct(5);

		require_once(ROOT . '/views/site/index.php');

		return true;
	}

}