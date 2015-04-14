<?php

require 'lib/plane.php';

class PlaneTest extends PHPUnit_Framework_TestCase{

  public function testPlaneExists(){
    $plane = new Plane();
    $expected = is_a($plane, 'Plane');
    $this->assertTrue($expected);
  }

  public function testPlaneIsNotFlying(){
    $plane = new Plane();
    $expected = $plane->flyingStatus;
    $this->assertTrue($expected);
  }

  public function testPlaneLands(){
    $plane = new Plane();
    $plane->land();
    $expected = $plane->flyingStatus;
    $this->assertFalse($expected);
  }

  public function testPlaneTakesOff(){
    $plane = new Plane();
    $plane->land();
    $plane->takeOff();
    $expected = $plane->flyingStatus;
    $this->assertTrue($expected);
  }  

}