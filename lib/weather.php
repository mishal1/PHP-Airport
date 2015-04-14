<?php

class Weather{

  public function check(){
    $weather = ['Sunny', 'Stormy'];
    $index = array_rand($weather);
    return $weather[$index];
  }

}