<?php

use Kirra\Polyfill\Translit as p;

if (!function_exists('transliterate')) {
	function transliterate_filters_get() { return p\Translit::transliterate_filters_get(); }
	function transliterate($string, array $filter_list, $charset_in = null, $charset_out = null) { return p\Translit::transliterate($string, $filter_list, $charset_in, $charset_out); }
}
