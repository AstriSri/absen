<?php

function ShortName($name)
{
    $arr_name = explode(" ",$name);
    for ($i=0; $i < count($arr_name); $i++) { 
        if ($i < 3){
            $arr_name[$i] = $arr_name[$i]." ";
        }else{
            $arr_name[$i] = substr($arr_name[$i], 0,1).". ";
        }
    }
    $new_name = implode($arr_name);
    return $new_name;
}
function daysInMonth(\Carbon\Carbon $tanggal, $inclusive = true)
{
	$carbon = \Carbon\Carbon::parse( $tanggal );
	$month = $carbon->month;
	$year = $carbon->year;
	$daysInMonth = $carbon->daysInMonth;
	$from = \Carbon\Carbon::parse( "$year-$month-1" );
	switch ($from->copy()->isoFormat("dddd")) {
		case 'Senin':
			$from = $from->subDays(1);
			break;
		
		case 'Selasa':
			$from = $from->subDays(2);
			break;
		
		case 'Rabu':
			$from = $from->subDays(3);
			break;
		
		case 'Kamis':
			$from = $from->subDays(4);
			break;
		
		case 'Jumat':
			$from = $from->subDays(5);
			break;
		
		case 'Sabtu':
			$from = $from->subDays(6);
			break;
	}
	$to = \Carbon\Carbon::parse( "$year-$month-$daysInMonth" );
	if ($from->gt($to)) {
		return null;
	}

	// Clone the date objects to avoid issues, then reset their time
	$from = $from->copy()->startOfDay();
	$to = $to->copy()->startOfDay();

	// Include the end date in the range
	if ($inclusive) {
		$to->addDay();
	}

	$step = \Carbon\CarbonInterval::day();
	$period = new DatePeriod($from, $step, $to);

	// Convert the DatePeriod into a plain array of Carbon objects
	$range = [];

	foreach ($period as $day) {
		$range[] = new \Carbon\Carbon($day);
	}

	return ! empty($range) ? $range : null;
}
?>