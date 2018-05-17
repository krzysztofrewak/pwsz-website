<?php

namespace PWSZ\Helpers;

use Carbon\Carbon;

class DateTimeTranslator {

	/**
	 * @param string $date
	 * @return string
	 */
	public static function getRealDate(string $date): string {
		$months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

		$translatedMonths = [
			"stycznia",
			"lutego",
			"marca",
			"kwietnia",
			"maja",
			"czerwca",
			"lipca",
			"sierpnia",
			"września",
			"października",
			"listopada",
			"grudnia",
		];

		return $date ? str_replace($months, $translatedMonths, Carbon::parse($date)
			->format("j M Y")) : "";
	}

	/**
	 * @param string $date
	 * @return string
	 */
	public static function getDateForHuman(string $date): string {
		$date = Carbon::parse($date);

		if($date->isToday()) {
			return "dziś";
		}

		if($date->isYesterday()) {
			return "wczoraj";
		}

		return $date->diffForHumans();
	}

}
