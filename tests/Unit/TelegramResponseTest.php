<?php

namespace Tests\Unit;

use CaliforniaMountainSnake\SocialNetworksAPI\Telegram\TelegramResponse;
use PHPUnit\Framework\TestCase;

class TelegramResponseTest extends TestCase
{
    /**
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public function testBad(): void
    {
        $rawResponse = [
            'ok' => 'false',
            'description' => 'this is description',
            'error_code' => '331'
        ];

        $response = new TelegramResponse($rawResponse);
        $this->assertFalse($response->isOk());
        $this->assertEquals('this is description', $response->getDescription());
        $this->assertEquals(331, $response->getErrorCode());
    }

    /**
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public function testGood(): void
    {
        $rawResponse = [
            'ok' => 'true',
            'result' => [
                'key_1' => 'value_1',
            ]
        ];

        $response = new TelegramResponse($rawResponse);
        $this->assertTrue($response->isOk());
        $this->assertEquals('value_1', $response->getResult('key_1'));
    }

    /**
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public function testArrayAccess(): void
    {
        $rawResponse = [
            'ok' => 'true',
            'result' => [
                'key_1' => 'value_1',
                'key_2' => [
                    'key_3' => 'value_3'
                ],
            ]
        ];

        $response = new TelegramResponse($rawResponse);
        $this->assertTrue($response->isOk());
        $this->assertEquals('value_1', $response->getResult('key_1'));
        $this->assertEquals('value_1', $response['result']['key_1']);
        $this->assertEquals('value_3', $response->getResult('key_2', 'key_3'));
        $this->assertEquals('value_3', $response['result']['key_2']['key_3']);
        $this->assertArrayNotHasKey('invalid_key', $response);
    }

    /**
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public function testCountable(): void
    {
        $rawResponse = [
            'ok' => 'true',
            'result' => [
                'key_1' => 'value_1',
            ]
        ];

        $response = new TelegramResponse($rawResponse);
        $this->assertTrue($response->isOk());
        $this->assertCount(2, $response);
    }
}
