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

  public function testCanDockAPlane(){
    $airport = $this->setUpTest('Sunny');
    $airport->dock($this->plane);
    $this->checkPlanesTest($airport, [$this->plane]);
  }

  public function testCanReleaseAPlane(){
    $airport = $this->setUpTest('Sunny');
    $airport->dock($this->plane);
    $airport->release($this->plane);
    $this->checkPlanesTest($airport, []);
  }

  public function testIsNotFull(){
    $airport = $this->setUpTest('Sunny');
    $expected = $airport->checkSpace();
    $this->assertTrue($expected);
  }

  public function testIsFull(){
    $airport = $this->setUpTest('Sunny', 1);
    $airport->dock($this->plane);
    $expected = $airport->checkSpace();
    $this->assertFalse($expected);
  }

  public function testCannotDockPlaneIfCapacityExceeded(){
    $airport = $this->setUpTest('Sunny', 1);
    $airport->dock($this->plane);
    $expected = $airport->dock($this->plane);
    $this->assertEquals($expected, 'Plane cannot land');
  }

  public function testCanCheckWeather(){
    $airport = $this->setUpTest('Sunny');
    $expected = $airport->checkWeather();
    $this->assertEquals($expected, 'Sunny');
  }

  public function testCannotDockPlaneIfWeatherStormy(){
    $airport = $this->setUpTest('Stormy');
    $expected = $airport->dock($this->plane);
    $this->assertEquals($expected, 'Plane cannot land');
  }

  public function testCannotReleasePlaneIfWeatherIsStormy(){
    $airport = $this->setUpTest('Stormy');
    $airport->planes = [$this->plane];
    $expected = $airport->release($this->plane);
    $this->assertEquals($expected, 'Plane cannot take off');
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
    $this->plane = $this->getMock('Plane');
    $weather = $this->createWeatherStub($setWeather);
    $airport = new Airport($weather);
    if($capacity){
      $airport = new Airport($weather, $capacity);
    }
    return $airport;
  }

}






