<?php defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('createSlug'))
{
	/**
	 * create slug
	 *
	 * Create a slug from you string
	 *
	 * @param	string	$str
	 * @param	string	$delimiter
	 * @return	string
	 */

	function createSlug($str, $delimiter = '-'){

    $slug = strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), $delimiter));
    return $slug;

	}
}