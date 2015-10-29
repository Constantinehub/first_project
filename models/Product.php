<?php

class Product
{

	const SHOW_BY_DEFAULT = 10;

	public static function getLatestProduct($count = self::SHOW_BY_DEFAULT)
	{

		$count = intval($count);

		$db = db::getConnection();

		$productsList = array();

		// $result = $db->query('SELECT id, name, price, is_new FROM product WHERE status = "1" ORDER BY id DESC LIMIT' . $count);
		// $limit = $db->query('LIMIT' . $count);
		$result = $db->query('SELECT id, name, price, is_new FROM product '
						. 'WHERE status = "1"'
						. 'ORDER BY id DESC '
						. 'LIMIT ' . $count);

		$i = 0;

		while($row = $result->fetch())
		{
			$productsList[$i]['id'] = $row['id'];
			$productsList[$i]['name'] = $row['name'];
			$productsList[$i]['price'] = $row['price'];
			$productsList[$i]['is_new'] = $row['is_new'];
			$i++;
		}

		return $productsList;
	}

	/*
	* Return an array of products
	*/

	public static function getProductsListByCategory($categoryId = false)
	{
		if($categoryId)	{
			$db = db::getConnection();

			$products = array();

			$result = $db->query("SELECT id, name, price, is_new FROM product "
						. "WHERE status = '1' AND category_id = '$categoryId' "
						. "ORDER BY id DESC "
						. "LIMIT " . self::SHOW_BY_DEFAULT);

			$i = 0;
			while($row = $result->fetch())	{
				$products[$i]['id'] = $row['id'];
				$products[$i]['name'] = $row['name'];
				$products[$i]['price'] = $row['price'];
				$products[$i]['is_new'] = $row['is_new'];
				$i++;
			}

			return $products;
		}
	}


/*
* Returns product Item by Id
* @param integer $id
*/
public static function getProductById($id)
{
	$id = intval($id);

	if($id)
	{
		$db = db::getConnection();

		$result = $db->query('SELECT * FROM product WHERE id =' . $id);
		$result->setFetchMode(PDO::FETCH_ASSOC);

		return $result->fetch();
	}
}






























}