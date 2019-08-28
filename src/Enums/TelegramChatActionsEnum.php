<?php

namespace CaliforniaMountainSnake\SocialNetworksAPI\Telegram\Enums;

use MyCLabs\Enum\Enum;

/**
 * The status is set for 5 seconds or less (when a message arrives from your bot, Telegram clients clear its typing status).
 */
class TelegramChatActionsEnum extends Enum
{
    public const TYPING = 'typing';
    public const UPLOAD_PHOTO = 'upload_photo';
    public const RECORD_VIDEO = 'record_video';
    public const UPLOAD_VIDEO = 'upload_video';
    public const RECORD_AUDIO = 'record_audio';
    public const UPLOAD_AUDIO = 'upload_audio';
    public const UPLOAD_DOCUMENT = 'upload_document';
    public const FIND_LOCATION = 'find_location';
    public const RECORD_VIDEO_NOTE = 'record_video_note';
    public const UPLOAD_VIDEO_NOTE = 'upload_video_note';

    //--------------------------------------------------------------------------
    // These methods are just for IDE autocomplete and not are mandatory.
    //--------------------------------------------------------------------------
    public static function TYPING(): self
    {
        return new self (self::TYPING);
    }

    public static function UPLOAD_PHOTO(): self
    {
        return new self (self::UPLOAD_PHOTO);
    }

    public static function RECORD_VIDEO(): self
    {
        return new self (self::RECORD_VIDEO);
    }

    public static function UPLOAD_VIDEO(): self
    {
        return new self (self::UPLOAD_VIDEO);
    }

    public static function RECORD_AUDIO(): self
    {
        return new self (self::RECORD_AUDIO);
    }

    public static function UPLOAD_AUDIO(): self
    {
        return new self (self::UPLOAD_AUDIO);
    }

    public static function UPLOAD_DOCUMENT(): self
    {
        return new self (self::UPLOAD_DOCUMENT);
    }

    public static function FIND_LOCATION(): self
    {
        return new self (self::FIND_LOCATION);
    }

    public static function RECORD_VIDEO_NOTE(): self
    {
        return new self (self::RECORD_VIDEO_NOTE);
    }

    public static function UPLOAD_VIDEO_NOTE(): self
    {
        return new self (self::UPLOAD_VIDEO_NOTE);
    }
}
