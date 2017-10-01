<?php

namespace PWSZ\Helpers;

class NumberToRoman {

	public static function transform(int $number): string {
		$roman_numbers = [
			"M" => 1000,
			"CM" => 900,
			"D" => 500,
			"CD" => 400,
			"C" => 100,
			"XC" => 90,
			"L" => 50,
			"XL" => 40,
			"X" => 10,
			"IX" => 9,
			"V" => 5,
			"IV" => 4,
			"I" => 1
		];

		$result = ""; 
		while($number > 0) { 
			foreach($roman_numbers as $roman => $arabic) { 
				if($number >= $arabic) { 
					$number -= $arabic; 
					$result .= $roman; 
					break; 
				}
			}
		}

		return $result; 
	}

}