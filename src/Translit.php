<?php

namespace Kirra\Polyfill\Translit;

/**
 * @internal
 */
final class Translit {
	private static $filters = [
		'uppercase_greek' => ['Kirra\\Polyfill\\Translit\\UppercaseGreek', 'convert'],
		'greek_uppercase' => ['Kirra\\Polyfill\\Translit\\UppercaseGreek', 'convert'],
		'jamo_transliterate' => ['Kirra\\Polyfill\\Translit\\JamoTransliterate', 'convert'],
		'cyrillic_transliterate' => ['Kirra\\Polyfill\\Translit\\CyrillicTransliterate', 'convert'],
		'cyrillic_transliterate_bulgarian' => ['Kirra\\Polyfill\\Translit\\CyrillicTransliterateBulgarian', 'convert'],
		'uppercase_latin' => ['Kirra\\Polyfill\\Translit\\UppercaseLatin', 'convert'],
		'latin_uppercase' => ['Kirra\\Polyfill\\Translit\\UppercaseLatin', 'convert'],
		'diacritical_remove' => ['Kirra\\Polyfill\\Translit\\DiacriticalRemove', 'convert'],
		'lowercase_cyrillic' => ['Kirra\\Polyfill\\Translit\\LowercaseCyrillic', 'convert'],
		'cyrillic_lowercase' => ['Kirra\\Polyfill\\Translit\\LowercaseCyrillic', 'convert'],
		'han_transliterate' => ['Kirra\\Polyfill\\Translit\\HanTransliterate', 'convert'],
		'normalize_punctuation' => ['Kirra\\Polyfill\\Translit\\NormalizePunctuation', 'convert'],
		'remove_punctuation' => ['Kirra\\Polyfill\\Translit\\RemovePunctuation', 'convert'],
		'spaces_to_underscore' => ['Kirra\\Polyfill\\Translit\\SpacesToUnderscore', 'convert'],
		'uppercase_cyrillic' => ['Kirra\\Polyfill\\Translit\\UppercaseCyrillic', 'convert'],
		'cyrillic_uppercase' => ['Kirra\\Polyfill\\Translit\\UppercaseCyrillic', 'convert'],
		'lowercase_greek' => ['Kirra\\Polyfill\\Translit\\LowercaseGreek', 'convert'],
		'greek_lowercase' => ['Kirra\\Polyfill\\Translit\\LowercaseGreek', 'convert'],
		'normalize_superscript_numbers' => ['Kirra\\Polyfill\\Translit\\NormalizeSuperscriptNumbers', 'convert'],
		'normalize_subscript_numbers' => ['Kirra\\Polyfill\\Translit\\NormalizeSubscriptNumbers', 'convert'],
		'normalize_numbers' => ['Kirra\\Polyfill\\Translit\\NormalizeNumbers', 'convert'],
		'normalize_superscript' => ['Kirra\\Polyfill\\Translit\\NormalizeSuperscript', 'convert'],
		'normalize_subscript' => ['Kirra\\Polyfill\\Translit\\NormalizeSubscript', 'convert'],
		'normalize_ligature' => ['Kirra\\Polyfill\\Translit\\NormalizeLigature', 'convert'],
		'decompose_special' => ['Kirra\\Polyfill\\Translit\\DecomposeSpecial', 'convert'],
		'decompose_currency_signs' => ['Kirra\\Polyfill\\Translit\\DecomposeCurrencySigns', 'convert'],
		'decompose' => ['Kirra\\Polyfill\\Translit\\Decompose', 'convert'],
		'greek_transliterate' => ['Kirra\\Polyfill\\Translit\\GreekTransliterate', 'convert'],
		'lowercase_latin' => ['Kirra\\Polyfill\\Translit\\LowercaseLatin', 'convert'],
		'latin_lowercase' => ['Kirra\\Polyfill\\Translit\\LowercaseLatin', 'convert'],
		'hebrew_transliterate' => ['Kirra\\Polyfill\\Translit\\HebrewTransliterate', 'convert'],
		'hangul_to_jamo' => ['Kirra\Polyfill\Translit\HangulToJamo', 'convert'],
		'compact_underscores' => ['Kirra\Polyfill\Translit\CompactUnderscores', 'convert'],
	];

	public static function transliterate_filters_get() {
		return array_keys(self::$filters);
	}

	public static function transliterate($string, array $filter_list, $charset_in = null, $charset_out = null) {
		if (strlen($charset_in)) {
			$string = iconv($charset_in, 'ucs-2le', $string);
		}

		$string = array_values(unpack('S*', $string));
		foreach ($filter_list as $filter) {
			if (isset(self::$filters[$filter])) {
				$string = call_user_func(self::$filters[$filter], $string);
			}
		}
		array_unshift($string, 'S*');
		$string = call_user_func_array('pack', $string);

		if (strlen($charset_out)) {
			$string = iconv('ucs-2le', $charset_out.'//IGNORE', $string);
		}

		return $string;
	}
}
