<?php

namespace CaliforniaMountainSnake\SocialNetworksAPI\Telegram\Enums;

use MyCLabs\Enum\Enum;

/**
 * This object represents one special entity in a text message. For example, hashtags, usernames, URLs, etc.
 */
class MessageEntityTypesEnum extends Enum
{
    /**
     * mention (@username)
     */
    public const MENTION = 'mention';

    /**
     * hashtag
     */
    public const HASHTAG = 'hashtag';

    /**
     * cashtag
     */
    public const CASHTAG = 'cashtag';

    /**
     * bot_command
     */
    public const BOT_COMMAND = 'bot_command';

    /**
     * url
     */
    public const URL = 'url';

    /**
     * email
     */
    public const EMAIL = 'email';

    /**
     * phone_number
     */
    public const PHONE_NUMBER = 'phone_number';

    /**
     * bold (bold text)
     */
    public const BOLD = 'bold';

    /**
     * italic (italic text)
     */
    public const ITALIC = 'italic';

    /**
     * code (monowidth string)
     */
    public const  CODE = 'code';

    /**
     * pre (monowidth block)
     */
    public const PRE = 'pre';

    /**
     * text_link (for clickable text URLs)
     */
    public const TEXT_LINK = 'text_link';

    /**
     * text_mention (for users without usernames)
     */
    public const TEXT_MENTION = 'text_mention';
}
