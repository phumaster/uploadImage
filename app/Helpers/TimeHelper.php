<?php

namespace App\Helpers;

class TimeHelper {
	public static function convert($time) {
		$oneYear = 31570560;
		$oneMonth = 2630880;
		$oneDay = 86400;
		$oneHour = 3600;
		if($time > $oneYear) 
			return floor($time/$oneYear).' year '.self::convert($time % $oneYear);
		else if($time > $oneMonth) 
			return floor($time/$oneMonth).' month '.self::convert($time % $oneMonth);
		else if($time > $oneDay) 
			return floor($time/$oneDay).' day '.self::convert($time % $oneDay);
		else if($time > $oneHour) 
			return floor($time/$oneHour).' hour '.self::convert($time % $oneHour);
		else if($time > 60)
			return floor($time/60).' min ago';
		else
			return 'just now';
	}
}