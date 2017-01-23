<?php
	function weightf($kgs) {
	    $lbs = $kgs * 2.20462;
	    $wf = ($lbs / 270);
	    $wf = pow($wf, 0.222);
	    $wf = number_format($wf,3);
	    return $wf;
	}

	function wfdist($dist, $wf) {
        $dist = $dist / $wf;
        $dist = floor($dist);
        return $dist;
    }

    function wftime($time, $wf) {
        $time = timetosecs($time);
        return secstotime($wf * $time);
    }

     function timetosecs($time) {
     	$time = explode(":", $time);
        return $time[0] * (60 * 60) + $time[1] * 60 + $time[2] * 1;
    }

    function secstotime($totalSeconds) {
        $hours = floor($totalSeconds / 3600);
        $totalSeconds %= 3600;
        $minutes = floor($totalSeconds / 60);
        $seconds = floor(($totalSeconds % 60) * 10) / 10;
        return $hours . ":" . $minutes . ":" . $seconds;
    }