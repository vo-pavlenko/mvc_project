<?php
  include_once ROOT.'/models/Category.php';
  include_once ROOT.'/models/Product.php';

	class ProductController {

		public function actionView($productId) {

			$categories = array();
			$categories = Category::getCategoriesList();

			$product = Product::getProductbyId($productId);

			require_once(ROOT.'/view/product/view.php');

			return true;
		}
	}
?>