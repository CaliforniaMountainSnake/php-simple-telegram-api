<?php

namespace Tests\Feature\Tests;

use CaliforniaMountainSnake\SocialNetworksAPI\Telegram\Exceptions\TelegramWrongResponseException;
use CaliforniaMountainSnake\SocialNetworksAPI\Telegram\SimpleTelegramApiAuthorized;
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
        $this->simpleApi = new SimpleTelegramApiAuthorized(\getenv('BOT_TOKEN'));
    }

    /**
     * @throws TelegramWrongResponseException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public function testSendMessage(): void
    {
        $arr = $this->simpleApi->sendMessage($this->simpleApi->getBotToken(), \getenv('TEST_CHANNEL_USERNAME'),
            'test from lib!');
        $this->assertIsArray($arr);

    }
}
