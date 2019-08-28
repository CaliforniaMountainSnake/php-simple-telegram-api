<?php

namespace CaliforniaMountainSnake\SocialNetworksAPI\Telegram\Enums;

use MyCLabs\Enum\Enum;

/**
 * The mediafile types which can be send to Telegram in the same method.
 */
class TelegramMediafileTypesEnum extends Enum
{
    public const PHOTO = 'photo';
    public const AUDIO = 'audio';
    public const VOICE = 'voice';
    public const DOCUMENT = 'document';
    public const VIDEO = 'video';
    public const ANIMATION = 'animation';
    public const VIDEO_NOTE = 'video_note';

    //--------------------------------------------------------------------------
    // These methods are just for IDE autocomplete and not are mandatory.
    //--------------------------------------------------------------------------
    public static function PHOTO(): self
    {
        return new self (self::PHOTO);
    }

    public static function AUDIO(): self
    {
        return new self (self::AUDIO);
    }

    public static function VOICE(): self
    {
        return new self (self::VOICE);
    }

    public static function DOCUMENT(): self
    {
        return new self (self::DOCUMENT);
    }

    public static function VIDEO(): self
    {
        return new self (self::VIDEO);
    }

    public static function ANIMATION(): self
    {
        return new self (self::ANIMATION);
    }

    public static function VIDEO_NOTE(): self
    {
        return new self (self::VIDEO_NOTE);
    }
}
