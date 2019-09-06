<?php

namespace CaliforniaMountainSnake\SocialNetworksAPI\Telegram\Utils;

use CaliforniaMountainSnake\SocialNetworksAPI\Telegram\Enums\ParseModeEnum;

trait ParseModeUtils
{
    /**
     * @var ParseModeEnum
     */
    protected $parseMode;

    /**
     * @return ParseModeEnum
     */
    public function getParseMode(): ParseModeEnum
    {
        return $this->parseMode ?? ParseModeEnum::HTML();
    }

    /**
     * @param ParseModeEnum $_parse_mode
     */
    public function setParseMode(ParseModeEnum $_parse_mode): void
    {
        $this->parseMode = $_parse_mode;
    }
}
