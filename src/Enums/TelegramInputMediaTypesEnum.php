<?php

namespace CaliforniaMountainSnake\SocialNetworksAPI\Telegram\Enums;

use MyCLabs\Enum\Enum;

class TelegramInputMediaTypesEnum extends Enum
{
    public const ANIMATION = 'animation';
    public const DOCUMENT = 'document';
    public const AUDIO = 'audio';
    public const PHOTO = 'photo';
    public const VIDEO = 'video';

    //--------------------------------------------------------------------------
    // These methods are just for IDE autocomplete and not are mandatory.
    //--------------------------------------------------------------------------
    /**
     * @return static
     */
    public static function ANIMATION(): self
    {
        return new static (static::ANIMATION);
    }

    /**
     * @return static
     */
    public static function DOCUMENT(): self
    {
        return new static (static::DOCUMENT);
    }

    /**
     * @return static
     */
    public static function AUDIO(): self
    {
        return new static (static::AUDIO);
    }

    /**
     * @return static
     */
    public static function PHOTO(): self
    {
        return new static (static::PHOTO);
    }

    /**
     * @return static
     */
    public static function VIDEO(): self
    {
        return new static (static::VIDEO);
    }
}
