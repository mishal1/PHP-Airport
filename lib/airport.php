<?php

class Airport{

  public $planes = [];

  public function __construct($weather, $capacity = 5){
    $this->capacity = $capacity;
    $this->weather = $weather;
  }

  public function receive($plane){
    $plane->land();
    array_push($this->planes, $plane);
  }

  public function release($plane){
    $plane->takeOff();
    $index = array_search($plane, $this->planes);
    unset($this->planes[$index]);
  }

  public function checkWeather(){
    return $this->weather->check();
  }

}