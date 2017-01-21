<?php
class Calculator
{
    private $name;
    private $wf;
    private $weight;
    private $distance;
    private $hours;
    private $mins;
    private $secs;
    private $time;

    public function __construct($name, $weight, $distance=null, $hours=0, $mins=0, $secs=0) {
        $this->name = $name;
        $this->weight = $weight;
        $this->wf = $this->weightf();
        $this->distance = $distance;
        $this->hours = $hours;
        $this->mins = $mins;
        $this->secs = $secs;
        $this->time = $this->timetosecs();
    }
    public function weightf() {
        $kg = $this->weight;
        $kg = $kg * 2.20462;
        $wf = ($kg / 270);
        $wf = pow($wf, 0.222);
        $wf = number_format($wf,3);
        return $wf;
    }
    public function splitTime() {

    }
    public function timetosecs() {
        return $this->hrs * (60 * 60) + $this->mins * 60 + $this->secs * 1;
    }

    public function secstotime($totalSeconds) {
        $hours = floor($totalSeconds / 3600);
        $totalSeconds %= 3600;
        $minutes = floor($totalSeconds / 60);
        $seconds = floor(($totalSeconds % 60) * 10) / 10;
        return $hours . ":" . $minutes . ":" . $seconds;
    }

    public function wfdist() {
        $dist = $this->distance;
        $dist = $dist / $this->wf;
        $dist = floor($dist);
        return $dist;
    }

    public function wftime() {
        $time = $this->timetosecs(null, 30, null);
        return $this->secstotime($this->wf * $time);
    }
    public function calculator() {
        $outputer = "<tr><td><b>" . ucwords($this->name) . " </b></td><td>" . $this->weight . " </td><td>" . $this->distance . " </td><td>" . $this->time . " </td><td>" . $this->wfdist() . " </td><td>" . $this->wftime() . " </td></tr>";
        return $outputer;
    }
}


