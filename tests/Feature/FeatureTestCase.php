<?php

namespace Tests\Feature;

use Dotenv\Dotenv;
use Dotenv\Exception\InvalidEncodingException;
use Dotenv\Exception\InvalidFileException;
use Dotenv\Exception\InvalidPathException;
use PHPUnit\Framework\TestCase;

class FeatureTestCase extends TestCase
{
    /**
     * @throws InvalidEncodingException
     * @throws InvalidFileException
     * @throws InvalidPathException
     */
    public function setUp()
    {
        parent::setUp();

        $dotenv = Dotenv::createImmutable(__DIR__);
        $dotenv->load();
    }
}
