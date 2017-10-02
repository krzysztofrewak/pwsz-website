<?php

namespace PWSZ\Helpers;

use Carbon\Carbon;

class DateTimeTranslator {

	public static function getRealDate(string $date): string {
		$months = [
			"Jan",
			"Feb",
			"Mar",
			"Apr",
			"May",
			"Jun",
			"Jul",
			"Aug",
			"Sep",
			"Oct",
			"Nov",
			"Dec"
		];

		$proper_months = [
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
			"grudnia"
		];

		return $date ? str_replace($months, $proper_months, Carbon::parse($date)->format("j M Y")) : "";
	}

	public static function getDateForHuman(string $date): string {
		$date = Carbon::parse($date);

		if($date->isToday()) {
			return "dziś";
		}
		
		return $date->diffForHumans();
	}

}
