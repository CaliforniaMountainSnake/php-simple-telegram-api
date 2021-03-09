<?php

namespace Tests\Feature\Tests;

use CaliforniaMountainSnake\SocialNetworksAPI\Telegram\Exceptions\TelegramWrongResponseException;
use CaliforniaMountainSnake\SocialNetworksAPI\Telegram\SimpleTelegramApiAuthorized;
use Dotenv\Exception\InvalidEncodingException;
use Dotenv\Exception\InvalidFileException;
use Dotenv\Exception\InvalidPathException;
use SebastianBergmann\RecursionContext\InvalidArgumentException;
use Tests\Feature\FeatureTestCase;

class SimpleTelegramApiTest extends FeatureTestCase
{
    /**
     * @var SimpleTelegramApiAuthorized
     */
    protected $simpleApi;

    /**
     * @throws InvalidEncodingException
     * @throws InvalidFileException
     * @throws InvalidPathException
     */
    public function setUp()
    {
        parent::setUp();
        $this->simpleApi = new SimpleTelegramApiAuthorized($_ENV['BOT_TOKEN']);
    }

    /**
     * @throws InvalidArgumentException
     * @throws TelegramWrongResponseException
     */
    public function testGetMe(): void
    {
        $me = $this->simpleApi->getMe($this->simpleApi->getBotToken());

        self::assertTrue($me->isOk());
        self::assertEquals(1, $me->getResult('is_bot'));
    }
}
