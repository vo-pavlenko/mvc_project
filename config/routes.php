<?php
	return array(
		'product/([0-9]+)' => 'product/view/$1', //actionView в ProductController
		'category/([0-9]+)' => 'catalog/category/$1', //actionCategory в CatalogController

		'catalog' => 'catalog/index', //actionIndex в CatalogController


		'' => 'site/index', //actionIndex в SiteController

	);
?>