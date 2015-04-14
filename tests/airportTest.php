<?php

require 'lib/airport.php';

class AirportTest extends PHPUnit_Framework_TestCase{

  public function testClassExists(){
    $airport = new Airport();
    $expected = is_a($airport, 'Airport');
    $this->assertTrue($expected);
  }

  public function testHasADefaultCapacity(){
    $airport = new Airport();
    $expected = $airport->capacity;
    $this->assertEquals($expected, 5);
  }

  public function testCanSetCapacity(){
    $airport = new Airport(10);
    $expected = $airport->capacity;
    $this->assertEquals($expected, 10);
  }

  public function testHasNoPlanes(){
    $airport = new Airport();
    $expected = $airport->planes;
    $this->assertEquals($expected, []);
  }

  public function testCanReceiveAPlane(){
    $plane = $this->getMock('Plane');
    $airport = new Airport();
    $airport->receive($plane);
    $expected = $airport->planes;
    $this->assertEquals($expected, [$plane]);
  }

  public function testCanReleaseAPlane(){
    $plane = $this->getMock('Plane');
    $airport = new Airport();
    $airport->receive($plane);
    $airport->release($plane);
    $expected = $airport->planes;
    $this->assertEquals($expected, []);
  }

}






