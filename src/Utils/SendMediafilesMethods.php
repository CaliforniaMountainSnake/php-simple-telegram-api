<?php

namespace CaliforniaMountainSnake\SocialNetworksAPI\Telegram\Utils;

use CaliforniaMountainSnake\SocialNetworksAPI\Telegram\Enums\ParseModeEnum;
use CaliforniaMountainSnake\SocialNetworksAPI\Telegram\Enums\TelegramMediafileTypesEnum;
use CaliforniaMountainSnake\SocialNetworksAPI\Telegram\TelegramResponse;

trait SendMediafilesMethods
{
    /**
     * Use this method to send a various types of the media files.
     *
     * @param string                     $_bot_token
     * @param string                     $_chat_id
     * @param TelegramMediafileTypesEnum $_type
     * @param string|\CURLFile           $_mediafile The http url to the file or CURLFile with it.
     * @param string|null                $_caption
     * @param ParseModeEnum|null         $_parse_mode
     * @param string|null                $_reply_markup_json
     *
     * @return TelegramResponse
     */
    abstract public function sendMediafile(
        string $_bot_token,
        string $_chat_id,
        TelegramMediafileTypesEnum $_type,
        $_mediafile,
        ?string $_caption = null,
        ?ParseModeEnum $_parse_mode = null,
        ?string $_reply_markup_json = null
    ): TelegramResponse;

    //------------------------------------------------------------------------------------------------------------------

    /**
     * Use this method to send photos.
     *
     * @param string             $_bot_token
     * @param string             $_chat_id
     * @param string|\CURLFile   $_photo The http url to the file or CURLFile with it.
     * @param string|null        $_caption
     * @param ParseModeEnum|null $_parse_mode
     * @param string|null        $_reply_markup_json
     *
     * @return TelegramResponse
     */
    public function sendPhoto(
        string $_bot_token,
        string $_chat_id,
        $_photo,
        ?string $_caption = null,
        ?ParseModeEnum $_parse_mode = null,
        ?string $_reply_markup_json = null
    ): TelegramResponse {
        return $this->sendMediafile($_bot_token, $_chat_id, TelegramMediafileTypesEnum::PHOTO(), $_photo, $_caption,
            $_parse_mode, $_reply_markup_json);
    }

    /**
     * Use this method to send audio files, if you want Telegram clients to display them in the music player.
     * Your audio must be in the .mp3 format. On success, the sent Message is returned.
     * Bots can currently send audio files of up to 50 MB in size, this limit may be changed in the future.
     *
     * @param string             $_bot_token
     * @param string             $_chat_id
     * @param string|\CURLFile   $_audio The http url to the file or CURLFile with it.
     * @param string|null        $_caption
     * @param ParseModeEnum|null $_parse_mode
     * @param string|null        $_reply_markup_json
     *
     * @return TelegramResponse
     */
    public function sendAudio(
        string $_bot_token,
        string $_chat_id,
        $_audio,
        ?string $_caption = null,
        ?ParseModeEnum $_parse_mode = null,
        ?string $_reply_markup_json = null
    ): TelegramResponse {
        return $this->sendMediafile($_bot_token, $_chat_id, TelegramMediafileTypesEnum::AUDIO(), $_audio, $_caption,
            $_parse_mode, $_reply_markup_json);
    }

    /**
     * Use this method to send audio files, if you want Telegram clients to display the file as a playable voice message.
     * For this to work, your audio must be in an .ogg file encoded with OPUS
     * (other formats may be sent as Audio or Document). On success, the sent Message is returned.
     * Bots can currently send voice messages of up to 50 MB in size, this limit may be changed in the future.
     *
     * @param string             $_bot_token
     * @param string             $_chat_id
     * @param string|\CURLFile   $_voice The http url to the file or CURLFile with it.
     * @param string|null        $_caption
     * @param ParseModeEnum|null $_parse_mode
     * @param string|null        $_reply_markup_json
     *
     * @return TelegramResponse
     */
    public function sendVoice(
        string $_bot_token,
        string $_chat_id,
        $_voice,
        ?string $_caption = null,
        ?ParseModeEnum $_parse_mode = null,
        ?string $_reply_markup_json = null
    ): TelegramResponse {
        return $this->sendMediafile($_bot_token, $_chat_id, TelegramMediafileTypesEnum::VOICE(), $_voice, $_caption,
            $_parse_mode, $_reply_markup_json);
    }

    /**
     * Use this method to send general files. On success, the sent Message is returned.
     * Bots can currently send files of any type of up to 50 MB in size, this limit may be changed in the future.
     *
     * @param string             $_bot_token
     * @param string             $_chat_id
     * @param string|\CURLFile   $_document The http url to the file or CURLFile with it.
     * @param string|null        $_caption
     * @param ParseModeEnum|null $_parse_mode
     * @param string|null        $_reply_markup_json
     *
     * @return TelegramResponse
     */
    public function sendDocument(
        string $_bot_token,
        string $_chat_id,
        $_document,
        ?string $_caption = null,
        ?ParseModeEnum $_parse_mode = null,
        ?string $_reply_markup_json = null
    ): TelegramResponse {
        return $this->sendMediafile($_bot_token, $_chat_id, TelegramMediafileTypesEnum::DOCUMENT(), $_document,
            $_caption, $_parse_mode, $_reply_markup_json);
    }

    /**
     * Use this method to send video files, Telegram clients support mp4 videos (other formats may be sent as Document).
     * On success, the sent Message is returned.
     * Bots can currently send video files of up to 50 MB in size, this limit may be changed in the future.
     *
     * @param string             $_bot_token
     * @param string             $_chat_id
     * @param string|\CURLFile   $_video The http url to the file or CURLFile with it.
     * @param string|null        $_caption
     * @param ParseModeEnum|null $_parse_mode
     * @param string|null        $_reply_markup_json
     *
     * @return TelegramResponse
     */
    public function sendVideo(
        string $_bot_token,
        string $_chat_id,
        $_video,
        ?string $_caption = null,
        ?ParseModeEnum $_parse_mode = null,
        ?string $_reply_markup_json = null
    ): TelegramResponse {
        return $this->sendMediafile($_bot_token, $_chat_id, TelegramMediafileTypesEnum::VIDEO(), $_video,
            $_caption, $_parse_mode, $_reply_markup_json);
    }

    /**
     * Use this method to send animation files (GIF or H.264/MPEG-4 AVC video without sound).
     * On success, the sent Message is returned.
     * Bots can currently send animation files of up to 50 MB in size, this limit may be changed in the future.
     *
     * @param string             $_bot_token
     * @param string             $_chat_id
     * @param string|\CURLFile   $_animation The http url to the file or CURLFile with it.
     * @param string|null        $_caption
     * @param ParseModeEnum|null $_parse_mode
     * @param string|null        $_reply_markup_json
     *
     * @return TelegramResponse
     */
    public function sendAnimation(
        string $_bot_token,
        string $_chat_id,
        $_animation,
        ?string $_caption = null,
        ?ParseModeEnum $_parse_mode = null,
        ?string $_reply_markup_json = null
    ): TelegramResponse {
        return $this->sendMediafile($_bot_token, $_chat_id, TelegramMediafileTypesEnum::ANIMATION(), $_animation,
            $_caption, $_parse_mode, $_reply_markup_json);
    }

    /**
     * As of v.4.0, Telegram clients support rounded square mp4 videos of up to 1 minute long.
     * Use this method to send video messages. On success, the sent Message is returned.
     *
     * @param string             $_bot_token
     * @param string             $_chat_id
     * @param string|\CURLFile   $_video_note The http url to the file or CURLFile with it.
     * @param string|null        $_caption
     * @param ParseModeEnum|null $_parse_mode
     * @param string|null        $_reply_markup_json
     *
     * @return TelegramResponse
     */
    public function sendVideoNote(
        string $_bot_token,
        string $_chat_id,
        $_video_note,
        ?string $_caption = null,
        ?ParseModeEnum $_parse_mode = null,
        ?string $_reply_markup_json = null
    ): TelegramResponse {
        return $this->sendMediafile($_bot_token, $_chat_id, TelegramMediafileTypesEnum::VIDEO_NOTE(), $_video_note,
            $_caption, $_parse_mode, $_reply_markup_json);
    }
}
