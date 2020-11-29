<?php

use App\Robot;
use PHPUnit\Framework\TestCase;

class RobotTest extends TestCase
{
    public $robot;

    public function setUp(): void
    {
        parent::setUp();
        $this->robot = new Robot;
    }

    public function testRobotMoveFunction(): void
    {
        $this->robot->place('1,1,NORTH');
        $this->robot->move();
        $this->assertEquals(['x' => 1, 'y' => 2, 'dir' => 'NORTH'], $this->robot->robot);

        $this->robot->place('1,1,SOUTH');
        $this->robot->move();
        $this->assertEquals(['x' => 1, 'y' => 0, 'dir' => 'SOUTH'], $this->robot->robot);

        $this->robot->place('1,1,WEST');
        $this->robot->move();
        $this->assertEquals(['x' => 0, 'y' => 1, 'dir' => 'WEST'], $this->robot->robot);

        $this->robot->place('1,1,EAST');
        $this->robot->move();
        $this->assertEquals(['x' => 2, 'y' => 1, 'dir' => 'EAST'], $this->robot->robot);
    }

    public function testRobotMoveTowardsEdgeFunction(): void
    {
        $this->robot->place('4,4,NORTH');
        $this->robot->move();
        $this->assertEquals(['x' => 4, 'y' => 4, 'dir' => 'NORTH'], $this->robot->robot);

        $this->robot->place('4,4,EAST');
        $this->robot->move();
        $this->assertEquals(['x' => 4, 'y' => 4, 'dir' => 'EAST'], $this->robot->robot);

        $this->robot->place('0,0,SOUTH');
        $this->robot->move();
        $this->assertEquals(['x' => 0, 'y' => 0, 'dir' => 'SOUTH'], $this->robot->robot);

        $this->robot->place('0,0,WEST');
        $this->robot->move();
        $this->assertEquals(['x' => 0, 'y' => 0, 'dir' => 'WEST'], $this->robot->robot);
    }

    public function testTurnRightFunction(): void
    {
        $this->robot->place('0,0,NORTH');
        $this->robot->turnRight();
        $this->assertEquals(['x' => 0, 'y' => 0, 'dir' => 'EAST'], $this->robot->robot);

        $this->robot->place('0,0,EAST');
        $this->robot->turnRight();
        $this->assertEquals(['x' => 0, 'y' => 0, 'dir' => 'SOUTH'], $this->robot->robot);

        $this->robot->place('0,0,SOUTH');
        $this->robot->turnRight();
        $this->assertEquals(['x' => 0, 'y' => 0, 'dir' => 'WEST'], $this->robot->robot);

        $this->robot->place('0,0,WEST');
        $this->robot->turnRight();
        $this->assertEquals(['x' => 0, 'y' => 0, 'dir' => 'NORTH'], $this->robot->robot);
    }

    public function testTurnLeftFunction(): void
    {
        $this->robot->place('0,0,NORTH');
        $this->robot->turnLeft();
        $this->assertEquals(['x' => 0, 'y' => 0, 'dir' => 'WEST'], $this->robot->robot);

        $this->robot->place('0,0,WEST');
        $this->robot->turnLeft();
        $this->assertEquals(['x' => 0, 'y' => 0, 'dir' => 'SOUTH'], $this->robot->robot);

        $this->robot->place('0,0,SOUTH');
        $this->robot->turnLeft();
        $this->assertEquals(['x' => 0, 'y' => 0, 'dir' => 'EAST'], $this->robot->robot);

        $this->robot->place('0,0,EAST');
        $this->robot->turnLeft();
        $this->assertEquals(['x' => 0, 'y' => 0, 'dir' => 'NORTH'], $this->robot->robot);
    }

    public function testOutOfBoundInput(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->robot->place('5,5,NORTH');
    }

    public function testInvalidInput(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->robot->place('0,0,TEST');
    }
}