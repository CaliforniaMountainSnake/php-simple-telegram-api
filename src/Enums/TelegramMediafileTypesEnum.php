<?php

namespace CaliforniaMountainSnake\SocialNetworksAPI\Telegram\Enums;

/**
 * The mediafile types which can be send to Telegram in the same method.
 */
class TelegramMediafileTypesEnum extends TelegramInputMediaTypesEnum
{
    public const VOICE = 'voice';
    public const VIDEO_NOTE = 'video_note';

    //--------------------------------------------------------------------------
    // These methods are just for IDE autocomplete and not are mandatory.
    //--------------------------------------------------------------------------
    /**
     * @return static
     */
    public static function VOICE(): self
    {
        return new static (static::VOICE);
    }

    /**
     * @return static
     */
    public static function VIDEO_NOTE(): self
    {
        return new static (static::VIDEO_NOTE);
    }
}
