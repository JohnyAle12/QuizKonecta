<?php

use Illuminate\Support\Facades\Cache;

if (! function_exists('countProductsOrder')) {
	function countProductsOrder(string $name): int
	{
		if (Cache::has($name)) {
            $cart = Cache::get($name);

			return array_sum(array_map(function($product) {
				return $product['quantity'];
			}, $cart));
        }
		return 0;
	}
}



