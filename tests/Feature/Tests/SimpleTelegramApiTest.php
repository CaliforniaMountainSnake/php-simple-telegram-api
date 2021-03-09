<?php

namespace Tests\Feature\Tests;

use CaliforniaMountainSnake\SocialNetworksAPI\Telegram\Exceptions\TelegramWrongResponseException;
use CaliforniaMountainSnake\SocialNetworksAPI\Telegram\SimpleTelegramApiAuthorized;
use SebastianBergmann\RecursionContext\InvalidArgumentException;
use Tests\Feature\FeatureTestCase;

class SimpleTelegramApiTest extends FeatureTestCase
{
    /**
     * @var SimpleTelegramApiAuthorized
     */
    protected $simpleApi;

    public function setUp()
    {
        parent::setUp();
        $this->simpleApi = new SimpleTelegramApiAuthorized(getenv('BOT_TOKEN'));
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
