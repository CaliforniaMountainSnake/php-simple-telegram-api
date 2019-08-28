<?php

namespace CaliforniaMountainSnake\SocialNetworksAPI\Telegram\Enums;

use MyCLabs\Enum\Enum;

class ParseModeEnum extends Enum
{
    public const MARKDOWN = 'markdown';
    public const HTML = 'html';
    public const STANDARD = '';

    //--------------------------------------------------------------------------
    // These methods are just for IDE autocomplete and not are mandatory.
    //--------------------------------------------------------------------------
    public static function MARKDOWN(): self
    {
        return new self (self::MARKDOWN);
    }

    public static function HTML(): self
    {
        return new self (self::HTML);
    }

    public static function STANDARD(): self
    {
        return new self (self::STANDARD);
    }
}
