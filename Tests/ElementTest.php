<?php

class ElementTest extends PHPUnit_Framework_TestCase
{
  public function testElement123()
  {
    // The order of children without a weight should be preserved.
    $element_mixed_weight = array(
      'child1' => array(),
      'child2' => array(),
      'child3' => array('#weight' => -10),
    );

    $expected = array('child3', 'child1', 'child2');
    $this->assertSame($expected, Element::children($element_mixed_weight, TRUE));
  }

  public function testElement132()
  {
    // The order of children without a weight should be preserved.
    $element_mixed_weight = array(
      'child1' => array(),
      'child3' => array('#weight' => -10),
      'child2' => array(),
    );

    $expected = array('child3', 'child1', 'child2');
    $this->assertSame($expected, Element::children($element_mixed_weight, TRUE));
  }

  public function testElement213()
  {
    // The order of children without a weight should be preserved.
    $element_mixed_weight = array(
      'child2' => array(),
      'child1' => array(),
      'child3' => array('#weight' => -10),
    );

    $expected = array('child3', 'child2', 'child1');
    $this->assertSame($expected, Element::children($element_mixed_weight, TRUE));
  }

  public function testElement231()
  {
    // The order of children without a weight should be preserved.
    $element_mixed_weight = array(
      'child2' => array(),
      'child3' => array('#weight' => -10),
      'child1' => array(),
    );

    $expected = array('child3', 'child2', 'child1');
    $this->assertSame($expected, Element::children($element_mixed_weight, TRUE));
  }

  public function testElement312()
  {
    // The order of children without a weight should be preserved.
    $element_mixed_weight = array(
      'child3' => array('#weight' => -10),
      'child1' => array(),
      'child2' => array(),
    );

    $expected = array('child3', 'child1', 'child2');
    $this->assertSame($expected, Element::children($element_mixed_weight, TRUE));
  }

  public function testElement321()
  {
    // The order of children without a weight should be preserved.
    $element_mixed_weight = array(
      'child3' => array('#weight' => -10),
      'child2' => array(),
      'child1' => array(),
    );

    $expected = array('child3', 'child2', 'child1');
    $this->assertSame($expected, Element::children($element_mixed_weight, TRUE));
  }

  public function testElementVarious()
  {
    // The order of children with same weight should be preserved.
    $element_mixed_weight = array(
      'child4' => array('#weight' => -20),
      'child3' => array('#weight' => -10),
      'child1' => array(),
      'child5' => array('#weight' => -20),
      'child2' => array(),
    );

    $expected = array('child4', 'child5', 'child3', 'child1', 'child2');
    $this->assertSame($expected, Element::children($element_mixed_weight, TRUE));
  }
}

