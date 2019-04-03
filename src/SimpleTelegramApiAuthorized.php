<?php

namespace CaliforniaMountainSnake\SocialNetworksAPI\Telegram;

class SimpleTelegramApiAuthorized extends SimpleTelegramApi
{
    /**
     * @var string
     */
    protected $botToken;

    public function __construct(string $_bot_token)
    {
        parent::__construct();
        $this->botToken = $_bot_token;
    }

    /**
     * @return string
     */
    public function getBotToken(): string
    {
        return $this->botToken;
    }
}
