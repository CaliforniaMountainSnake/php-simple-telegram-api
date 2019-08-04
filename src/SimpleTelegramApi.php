<?php

namespace CaliforniaMountainSnake\SocialNetworksAPI\Telegram;

use CaliforniaMountainSnake\SocialNetworksAPI\Telegram\Exceptions\TelegramWrongResponseException;
use CaliforniaMountainSnake\UtilTraits\Curl\CurlUtils;

/**
 * Простой класс реализации НЕКОТОРЫХ методов Telegram BOT API.
 */
class SimpleTelegramApi
{
    use CurlUtils;

    public const TELEGRAM_BOT_API_URL = 'https://api.telegram.org/bot';
    public const GET_ME               = 'getMe';
    public const GET_CHAT             = 'getChat';
    public const GET_CHAT_MEMBER      = 'getChatMember';
    public const DELETE_MESSAGE       = 'deleteMessage';
    public const SEND_MESSAGE         = 'sendMessage';
    public const SEND_AUDIO           = 'sendAudio';
    public const SET_WEBHOOK          = 'setWebhook';

    /**
     * @var ParseModeEnum
     */
    protected $defaultParseMode;

    public function __construct()
    {
        $this->defaultParseMode = ParseModeEnum::HTML();
    }

    /**
     * Parse mode, used in the all methods by default.
     * @return ParseModeEnum
     */
    public function getDefaultParseMode(): ParseModeEnum
    {
        return $this->defaultParseMode;
    }

    /**
     * @param ParseModeEnum $_parse_mode
     */
    public function setDefaultParseMode(ParseModeEnum $_parse_mode): void
    {
        $this->defaultParseMode = $_parse_mode;
    }

    //------------------------------------------------------------------------------------------------------------------

    /**
     * A simple method for testing your bot's auth token. Requires no parameters.
     * Returns basic information about the bot in form of a User object.
     *
     * @param string $_bot_token
     * @return array
     * @throws TelegramWrongResponseException
     */
    public function getMe(string $_bot_token): array
    {
        return $this->sendQuery($_bot_token, self::GET_ME, []);
    }

    /**
     * @param string $_bot_token
     * @return array
     * @throws TelegramWrongResponseException
     */
    public function getBotUsername(string $_bot_token): array
    {
        return $this->getMe($_bot_token)['result']['username'];
    }

    /**
     * Use this method to get up to date information about the chat
     * (current name of the user for one-on-one conversations, current username of a user, group or channel, etc.).
     * Returns a Chat object on success.
     *
     * @param string $_bot_token
     * @param string $_chat_id
     * @return array
     * @throws TelegramWrongResponseException
     */
    public function getChat(string $_bot_token, string $_chat_id): array
    {
        return $this->sendQuery($_bot_token, self::GET_CHAT, [
            'chat_id' => $_chat_id
        ]);
    }

    /**
     * Use this method to get information about a member of a chat. Returns a ChatMember object on success.
     *
     * @param string $_bot_token
     * @param string $_chat_id
     * @param string $_user_id
     * @return array
     * @throws TelegramWrongResponseException
     */
    public function getChatMember(string $_bot_token, string $_chat_id, string $_user_id): array
    {
        return $this->sendQuery($_bot_token, self::GET_CHAT_MEMBER, [
            'chat_id' => $_chat_id,
            'user_id' => $_user_id,
        ]);
    }

    /**
     * Use this method to delete a message, including service messages, with the following limitations:
     * A message can only be deleted if it was sent less than 48 hours ago.
     * Bots can delete outgoing messages in private chats, groups, and supergroups.
     * Bots can delete incoming messages in private chats.
     * Bots granted can_post_messages permissions can delete outgoing messages in channels.
     * If the bot is an administrator of a group, it can delete any message there.
     * If the bot has can_delete_messages permission in a supergroup or a channel, it can delete any message there.
     *
     * @param string $_bot_token
     * @param string $_chat_id
     * @param string $_message_id
     * @return array
     * @throws TelegramWrongResponseException
     */
    public function deleteMessage(string $_bot_token, string $_chat_id, string $_message_id): array
    {
        return $this->sendQuery($_bot_token, self::DELETE_MESSAGE, [
            'chat_id' => $_chat_id,
            'message_id' => $_message_id,
        ]);
    }

    /**
     * Use this method to send text messages. On success, the sent Message is returned.
     *
     * @param string $_bot_token
     * @param string $_chat_id
     * @param string $_text
     * @param ParseModeEnum|null $_parse_mode
     * @param string|null $_reply_markup_json
     * @return array
     * @throws TelegramWrongResponseException
     */
    public function sendMessage(
        string $_bot_token,
        string $_chat_id,
        string $_text,
        ?ParseModeEnum $_parse_mode = null,
        ?string $_reply_markup_json = null
    ): array {
        $params = [
            'chat_id' => $_chat_id,
            'text' => $_text,
            'parse_mode' => (string)($_parse_mode ?? $this->getDefaultParseMode())
        ];
        if ($_reply_markup_json !== null) {
            $params['reply_markup'] = $_reply_markup_json;
        }

        return $this->sendQuery($_bot_token, self::SEND_MESSAGE, $params);
    }

    /**
     * Use this method to send audio files, if you want Telegram clients to display them in the music player.
     * Your audio must be in the .mp3 format. On success, the sent Message is returned.
     * Bots can currently send audio files of up to 50 MB in size, this limit may be changed in the future.
     *
     * @param string $_bot_token
     * @param string $_chat_id
     * @param string $_audio
     * @param string|null $_caption
     * @param ParseModeEnum|null $_parse_mode
     * @param string|null $_reply_markup_json
     * @return array
     * @throws TelegramWrongResponseException
     */
    public function sendAudio(
        string $_bot_token,
        string $_chat_id,
        string $_audio,
        ?string $_caption = null,
        ?ParseModeEnum $_parse_mode = null,
        ?string $_reply_markup_json = null
    ): array {
        $params = [
            'chat_id' => $_chat_id,
            'audio' => $_audio,
            'parse_mode' => (string)($_parse_mode ?? $this->getDefaultParseMode())
        ];
        if ($_caption !== null) {
            $params['caption'] = $_caption;
        }
        if ($_reply_markup_json !== null) {
            $params['reply_markup'] = $_reply_markup_json;
        }

        return $this->sendQuery($_bot_token, self::SEND_AUDIO, $params);
    }

    /**
     * @param string $_bot_token
     * @param string $_webhook_url
     *
     * @return array
     * @throws TelegramWrongResponseException
     */
    public function setWebhookGoodSSL(string $_bot_token, string $_webhook_url): array
    {
        return $this->sendQuery($_bot_token, self::SET_WEBHOOK, [
            'url' => $_webhook_url,
        ]);
    }

    /**
     * @param string $_bot_token
     * @param string $_webhook_url
     * @param string $_certificate_filename
     *
     * @return array
     * @throws TelegramWrongResponseException
     */
    public function setWebhookSelfSigned(
        string $_bot_token,
        string $_webhook_url,
        string $_certificate_filename
    ): array {
        return $this->sendQuery($_bot_token, self::SET_WEBHOOK, [
            'url' => $_webhook_url,
            'certificate' => new \CurlFile ($_certificate_filename),
        ]);
    }

    /**
     * Send any query to the Telegram BOT API.
     *
     * @param string $_bot_token
     * @param string $_method
     * @param array $_postfields
     *
     * @return array JSON-Decoded Telegram response.
     * @throws TelegramWrongResponseException Throws in case if it's impossible to parse the Telegram response.
     */
    public function sendQuery(string $_bot_token, string $_method, array $_postfields): array
    {
        $telegramResponse = $this->postQuery(self::TELEGRAM_BOT_API_URL
            . $_bot_token . '/' . $_method, $_postfields);

        $telegramResponseJson = $telegramResponse->jsonDecode();
        if (\json_last_error() === \JSON_ERROR_NONE) {
            return $telegramResponseJson;
        }

        throw new TelegramWrongResponseException ("Can't parse Telegram's json response! Code: "
            . $telegramResponse->getCode() . '. Content: "'
            . $telegramResponse->getContent() . '"', $telegramResponse->getCode());
    }
}
