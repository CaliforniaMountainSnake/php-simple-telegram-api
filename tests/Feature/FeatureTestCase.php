<?php

namespace Tests\Feature;

use Dotenv\Dotenv;
use Dotenv\Exception\InvalidFileException;
use Dotenv\Exception\InvalidPathException;
use PHPUnit\Framework\TestCase;

class FeatureTestCase extends TestCase
{
    /**
     * @throws InvalidFileException
     * @throws InvalidPathException
     */
    public function setUp()
    {
        parent::setUp();

        $dotenv = new Dotenv(__DIR__);
        $dotenv->load();
    }
}
