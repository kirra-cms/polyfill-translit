<?php

/*
 * Warning: Do not edit!
 * This file is generated from a transliteration definition table with the name
 * "/var/workspaces/translit/php-translit/Resources/data/normalize_punctuation.tr".
 */

namespace Kirra\Polyfill\Translit;

class RemovePunctuation {
	private static $jump_table = [
		[
			0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
			0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
			0, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3,
			0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3, 3, 3, 3, 3, 3,
			0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
			0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3, 3, 3, 3, 3,
			3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
			0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3, 3, 3, 3, 0,
			0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
			0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
			0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
			0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
			0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
			0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
			0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
			0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
		],
	];

	public static function convert(array $in)
	{
		/* Determine initial string length */
		$in_length = count($in);
		$out = [];

		/* Loop over input array */
		for ($i = 0; $i < $in_length; $i++) {
			$block = $in[$i] >> 8;
			$cp    = $in[$i] & 255;

			$no_jump = 0;
			switch ($block) {
				case 0: $jump_map = self::$jump_table[0]; break;
				default: $no_jump = 1;
			}
			if ($no_jump) {
				$jump = 0;
			} else {
				$jump = $jump_map[$cp];
			}

			switch ($jump) {
				case 0: /* No changes */
					$out[] = $in[$i];
					break;
				case 3: /* Skip */
					break;
			}
		}
		return $out;
	}
}
