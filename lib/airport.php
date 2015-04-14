<?php

class Airport{

  public $planes = [];

  public function __construct($weather, $capacity = 5){
    $this->capacity = $capacity;
    $this->weather = $weather;
  }

  public function dock($plane){
    if($this->okayToFly()){
      $plane->land();
      array_push($this->planes, $plane);
    } else {
      return 'Plane cannot land';
    }
  }

  public function release($plane){
    if($this->checkWeather() == 'Sunny'){
      $plane->takeOff();
      $index = array_search($plane, $this->planes);
      unset($this->planes[$index]);
    } else {
      return 'Plane cannot take off';
    }
  }

  public function checkWeather(){
    return $this->weather->check();
  }

  public function checkSpace(){
    return count($this->planes) < $this->capacity;
  }

  public function okayToFly(){
    return $this->checkSpace() && $this->checkWeather() == 'Sunny';
  }

}