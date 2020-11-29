<?php

namespace App;

use InvalidArgumentException;

class Robot {

    public $robot;
    public $directions = ['NORTH', 'EAST', 'SOUTH', 'WEST'];

    /**
     * Executes user command
     *
     * @param $command
     */
    public function executeCommand($command): void
    {
        $action = explode(' ', $command);
        switch (trim($action[0])) {
            case 'PLACE':
                $this->place($action[1]);
                break;
            case 'MOVE':
                $this->move();
                break;
            case 'LEFT':
                $this->turnLeft();
                break;
            case 'RIGHT':
                $this->turnRight();
                break;
            case 'REPORT':
                $this->report();
                break;
            default:
                echo('Please enter a valid command'. PHP_EOL);
                break;
        }
    }

    /**
     * Place robot on it's initial square
     *
     * @param $position
     */
    public function place($position): void
    {
        $position = explode(',', $position);
        $x = (int) $position[0];
        $y = (int) $position[1];
        $dir = trim($position[2]);
        if ($this->isValid($x, $y, $dir)) {
            $this->robot = [
                'x' => $x,
                'y' => $y,
                'dir' => $dir
            ];
        }
    }

    /**
     * Move robot function
     *
     * @return bool
     */
    public function move(): bool
    {
        if (is_null($this->robot)) {
            throw new InvalidArgumentException('Please place robot first');
        }
        switch ($this->robot['dir']) {
            case 'NORTH':
                if ($this->robot['y'] + 1 > 4) {
                    return false;
                }
                ++$this->robot['y'];
                break;
            case 'SOUTH':
                if ($this->robot['y'] - 1 < 0) {
                    return false;
                }
                --$this->robot['y'];
                break;
            case 'EAST':
                if ($this->robot['x'] + 1 > 4) {
                    return false;
                }
                ++$this->robot['x'];
                break;
            case 'WEST':
                if ($this->robot['x'] - 1 < 0) {
                    return false;
                }
                --$this->robot['x'];
                break;
        }
        return false;
    }

    /**
     * Turns direction to right
     */
    public function turnRight(): void
    {
        if (is_null($this->robot)) {
            throw new InvalidArgumentException('Please place robot first!');
        }
        $index = array_search($this->robot['dir'], $this->directions, true);
        if ($index === 3) {
            $this->robot['dir'] = $this->directions[0];
        } else {
            $this->robot['dir'] = $this->directions[$index + 1];
        }
    }

    /**
     * Turns direction to left
     */
    public function turnLeft(): void
    {
        if (is_null($this->robot)) {
            throw new InvalidArgumentException('Please place robot first!');
        }
        $index = array_search($this->robot['dir'], $this->directions, true);
        if ($index === 0) {
            $this->robot['dir'] = $this->directions[3];
        } else {
            $this->robot['dir'] = $this->directions[$index - 1];
        }
    }

    /**
     * Reporting function
     */
    public function report(): void
    {
        if (is_null($this->robot)) {
            throw new InvalidArgumentException('Please place robot first!');
        }
        $result = $this->robot['x'] . ',' . $this->robot['y'] . ',' . $this->robot['dir'];
        echo($result. PHP_EOL);
    }

    /**
     * Check if inputs are valid
     *
     * @param $x
     * @param $y
     * @param $dir
     * @return bool
     */
    public function isValid($x, $y, $dir): bool
    {
        if ($x < 0 || $x > 4 || $y < 0 || $y > 4) {
            throw new InvalidArgumentException('Index out of bound!');
        }
        if (!in_array($dir, $this->directions, true)) {
            throw new InvalidArgumentException('Please enter a valid direction!');
        }
        return true;
    }
}
