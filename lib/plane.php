<?php

class Plane{

  public $flyingStatus = true;

  public function land(){
    $this->flyingStatus = false;
  }

  public function takeOff(){
    $this->flyingStatus = true;
  }

}