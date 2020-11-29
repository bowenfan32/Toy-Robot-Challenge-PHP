<?php

use App\Robot;
require "vendor/autoload.php";

class Main {

    public function run(): void
    {
        $robot = new Robot();
        $handle = fopen('php://stdin', 'rb');
        while (($command = fgets($handle)) !== false) {
            $robot->executeCommand($command);
        }
        fclose($handle);
    }
}

$main = new Main();
$main->run();