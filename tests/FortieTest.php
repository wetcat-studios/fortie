<?php
 
use Wetcat\Fortie\Fortie;
 
class FortieTest extends PHPUnit_Framework_TestCase {
 
  public function testNachHasCheese()
  {
    $fortie = new Fortie;
    $this->assertTrue($fortie->testFunc());
  }
 
}