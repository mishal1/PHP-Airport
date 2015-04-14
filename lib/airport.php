<?php

class Airport{

  public $planes = [];

  public function __construct($capacity = 5){
    $this->capacity = $capacity;
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

}