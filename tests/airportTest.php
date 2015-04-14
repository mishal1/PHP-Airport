<?php

require 'lib/airport.php';

class AirportTest extends PHPUnit_Framework_TestCase{

  public function testClassExists(){
    $airport = $this->setUpTest('Sunny');
    $expected = is_a($airport, 'Airport');
    $this->assertTrue($expected);
  }

  public function testHasADefaultCapacity(){
    $airport = $this->setUpTest('Sunny');
    $expected = $airport->capacity;
    $this->assertEquals($expected, 5);
  }

  public function testCanSetCapacity(){
    $airport = $this->setUpTest('Sunny', 10);
    $expected = $airport->capacity;
    $this->assertEquals($expected, 10);
  }

  public function testHasNoPlanes(){
    $airport = $this->setUpTest('Sunny');
    $this->checkPlanesTest($airport, []);
  }

  public function testCanReceiveAPlane(){
    $plane = $this->getMock('Plane');
    $airport = $this->setUpTest('Sunny');
    $airport->receive($plane);
    $this->checkPlanesTest($airport, [$plane]);
  }

  public function testCanReleaseAPlane(){
    $plane = $this->getMock('Plane');
    $airport = $this->setUpTest('Sunny');
    $airport->receive($plane);
    $airport->release($plane);

    $this->checkPlanesTest($airport, []);
  }

  public function testCanCheckWeather(){
    $airport = $this->setUpTest('Sunny');
    $expected = $airport->checkWeather();
    $this->assertEquals($expected, 'Sunny');
  }

  // helpers
  public function checkPlanesTest($airport, $actual){
    $expected = $airport->planes;
    $this->assertEquals($expected, $actual);
  }

  public function createWeatherStub($setWeather){
    $weather = $this->getMockBuilder('Weather')
                    ->getMock();
    $weather->method('check')
            ->willReturn($setWeather);
    return $weather;
  }

  public function setUpTest($setWeather, $capacity = null){
    $weather = $this->createWeatherStub('Sunny');
    $airport = new Airport($weather);
    if($capacity){
      $airport = new Airport($weather, $capacity);
    }
    return $airport;
  }

}






