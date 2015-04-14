<?php

require 'lib/weather.php';

class WeatherTest extends PHPUnit_Framework_TestCase{

  public function testWeatherExists(){
    $weather = new Weather();
    $expected = is_a($weather, 'Weather');
  }

  public function testGeneratesWeather(){
    $weather = new Weather();
    $currentWeather = $weather->check();
    $expected = $currentWeather == 'Sunny' || $currentWeather == 'Stormy';
    $this->assertTrue($expected);
  }

}