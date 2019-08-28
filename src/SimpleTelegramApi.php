<?php

namespace CaliforniaMountainSnake\SocialNetworksAPI\Telegram;

use CaliforniaMountainSnake\SocialNetworksAPI\Telegram\Enums\ParseModeEnum;
use CaliforniaMountainSnake\SocialNetworksAPI\Telegram\Enums\TelegramChatActionsEnum;
use CaliforniaMountainSnake\SocialNetworksAPI\Telegram\Enums\TelegramMediafileTypesEnum;
use CaliforniaMountainSnake\SocialNetworksAPI\Telegram\Exceptions\TelegramWrongResponseException;
use CaliforniaMountainSnake\SocialNetworksAPI\Telegram\Utils\SendMediafilesMethods;
use CaliforniaMountainSnake\UtilTraits\Curl\CurlUtils;

/**
 * The simple class with realisation of SOME methods of Telegram BOT API.
 */
class SimpleTelegramApi
{
    use CurlUtils;
    use SendMediafilesMethods;

    public const TELEGRAM_BOT_API_URL = 'https://api.telegram.org/bot';
    public const GET_ME = 'getMe';
    public const GET_CHAT = 'getChat';
    public const GET_CHAT_MEMBER = 'getChatMember';
    public const DELETE_MESSAGE = 'deleteMessage';
    public const SET_WEBHOOK = 'setWebhook';
    public const SEND_MESSAGE = 'sendMessage';
    public const SEND_PHOTO = 'sendPhoto';
    public const SEND_AUDIO = 'sendAudio';
    public const SEND_VOICE = 'sendVoice';
    public const SEND_DOCUMENT = 'sendDocument';
    public const SEND_VIDEO = 'sendVideo';
    public const SEND_ANIMATION = 'sendAnimation';
    public const SEND_VIDEO_NOTE = 'sendVideoNote';
    public const SEND_POLL = 'sendPoll';
    public const SEND_CHAT_ACTION = 'sendChatAction';

    /**
     * @var ParseModeEnum
     */
    protected $defaultParseMode;

    /**
     * SimpleTelegramApi constructor.
     *
     * @param ParseModeEnum|null $_default_parse_mode
     */
    public function __construct(?ParseModeEnum $_default_parse_mode = null)
    {
        $this->defaultParseMode = $_default_parse_mode ?? ParseModeEnum::HTML();
    }

    /**
     * Parse mode, used in the all methods by default.
     *
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
     *
     * @return TelegramResponse
     * @throws TelegramWrongResponseException
     */
    public function getMe(string $_bot_token): TelegramResponse
    {
        return $this->sendQuery($_bot_token, self::GET_ME);
    }

    /**
     * @param string $_bot_token
     *
     * @return string
     * @throws TelegramWrongResponseException
     */
    public function getBotUsername(string $_bot_token): string
    {
        return $this->getMe($_bot_token)->getResult('username');
    }

    /**
     * Use this method to get up to date information about the chat
     * (current name of the user for one-on-one conversations, current username of a user, group or channel, etc.).
     * Returns a Chat object on success.
     *
     * @param string $_bot_token
     * @param string $_chat_id
     *
     * @return TelegramResponse
     * @throws TelegramWrongResponseException
     */
    public function getChat(string $_bot_token, string $_chat_id): TelegramResponse
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
     *
     * @return TelegramResponse
     * @throws TelegramWrongResponseException
     */
    public function getChatMember(string $_bot_token, string $_chat_id, string $_user_id): TelegramResponse
    {
        return $this->sendQuery($_bot_token, self::GET_CHAT_MEMBER, [
            'chat_id' => $_chat_id,
            'user_id' => $_user_id,
        ]);
    }

    /**
     * @param string $_bot_token
     * @param string $_webhook_url
     *
     * @return TelegramResponse
     * @throws TelegramWrongResponseException
     */
    public function setWebhookGoodSSL(string $_bot_token, string $_webhook_url): TelegramResponse
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
     * @return TelegramResponse
     * @throws TelegramWrongResponseException
     */
    public function setWebhookSelfSigned(
        string $_bot_token,
        string $_webhook_url,
        string $_certificate_filename
    ): TelegramResponse {
        return $this->sendQuery($_bot_token, self::SET_WEBHOOK, [
            'url' => $_webhook_url,
            'certificate' => new \CurlFile ($_certificate_filename),
        ]);
    }

    /**
     * Use this method when you need to tell the user that something is happening on the bot's side.
     * The status is set for 5 seconds or less.
     * When a message arrives from your bot, Telegram clients clear its typing status.
     *
     * @param string                  $_bot_token
     * @param string                  $_chat_id
     * @param TelegramChatActionsEnum $_action
     *
     * @return TelegramResponse
     * @throws TelegramWrongResponseException
     */
    public function sendChatAction(
        string $_bot_token,
        string $_chat_id,
        TelegramChatActionsEnum $_action
    ): TelegramResponse {
        return $this->sendQuery($_bot_token, self::SEND_CHAT_ACTION, [
            'chat_id' => $_chat_id,
            'action' => (string)$_action,
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
     *
     * @return TelegramResponse
     * @throws TelegramWrongResponseException
     */
    public function deleteMessage(string $_bot_token, string $_chat_id, string $_message_id): TelegramResponse
    {
        return $this->sendQuery($_bot_token, self::DELETE_MESSAGE, [
            'chat_id' => $_chat_id,
            'message_id' => $_message_id,
        ]);
    }

    /**
     * Use this method to send a native poll. A native poll can't be sent to a private chat.
     * On success, the sent Message is returned.
     *
     * @param string      $_bot_token
     * @param string      $_chat_id
     * @param string      $_question Poll question, 1-255 characters.
     * @param string[]    $_options  List of answer options, 2-10 strings 1-100 characters each.
     * @param string|null $_reply_markup_json
     *
     * @return TelegramResponse
     * @throws TelegramWrongResponseException
     */
    public function sendPoll(
        string $_bot_token,
        string $_chat_id,
        string $_question,
        array $_options,
        ?string $_reply_markup_json = null
    ): TelegramResponse {
        $params = [
            'chat_id' => $_chat_id,
            'question' => $_question,
            'options' => \json_encode($_options),
        ];
        $_reply_markup_json !== null && $params['reply_markup'] = $_reply_markup_json;

        return $this->sendQuery($_bot_token, self::SEND_POLL, $params);
    }

    //------------------------------------------------------------------------------------------------------------------

    /**
     * Use this method to send text messages. On success, the sent Message is returned.
     *
     * @param string             $_bot_token
     * @param string             $_chat_id
     * @param string             $_text
     * @param ParseModeEnum|null $_parse_mode
     * @param string|null        $_reply_markup_json
     *
     * @return TelegramResponse
     * @throws TelegramWrongResponseException
     */
    public function sendMessage(
        string $_bot_token,
        string $_chat_id,
        string $_text,
        ?ParseModeEnum $_parse_mode = null,
        ?string $_reply_markup_json = null
    ): TelegramResponse {
        $params = [
            'chat_id' => $_chat_id,
            'text' => $_text,
            'parse_mode' => (string)($_parse_mode ?? $this->getDefaultParseMode())
        ];

        $_reply_markup_json !== null && $params['reply_markup'] = $_reply_markup_json;

        return $this->sendQuery($_bot_token, self::SEND_MESSAGE, $params);
    }

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
     * @throws TelegramWrongResponseException
     */
    public function sendMediafile(
        string $_bot_token,
        string $_chat_id,
        TelegramMediafileTypesEnum $_type,
        $_mediafile,
        ?string $_caption = null,
        ?ParseModeEnum $_parse_mode = null,
        ?string $_reply_markup_json = null
    ): TelegramResponse {
        $params = [
            'chat_id' => $_chat_id,
            (string)$_type => $_mediafile,
            'parse_mode' => (string)($_parse_mode ?? $this->getDefaultParseMode())
        ];

        $_caption !== null && $params['caption'] = $_caption;
        $_reply_markup_json !== null && $params['reply_markup'] = $_reply_markup_json;

        return $this->sendQuery($_bot_token, 'send' . \ucfirst((string)$_type), $params);
    }

    //------------------------------------------------------------------------------------------------------------------

    /**
     * Send any query to the Telegram BOT API.
     *
     * @param string $_bot_token
     * @param string $_method
     * @param array  $_postfields
     *
     * @return TelegramResponse Telegram response.
     * @throws TelegramWrongResponseException Throws in case if it's impossible to parse the Telegram response.
     */
    public function sendQuery(string $_bot_token, string $_method, array $_postfields = []): TelegramResponse
    {
        $telegramResponse = $this->postQuery(self::TELEGRAM_BOT_API_URL . $_bot_token . '/' . $_method, $_postfields);

        $content = $telegramResponse->getContent();
        if (empty($content)) {
            throw new TelegramWrongResponseException('Telegram response is empty! Response: "' . $content . '"');
        }

        $telegramResponseJson = $telegramResponse->jsonDecode();
        if (\json_last_error() !== \JSON_ERROR_NONE) {
            throw new TelegramWrongResponseException ("Can't parse Telegram's json response! Http code: "
                . $telegramResponse->getCode() . '. Response: "'
                . $telegramResponse->getContent() . '"', $telegramResponse->getCode());
        }

        $response = new TelegramResponse($telegramResponseJson);
        if (!$response->isOk()) {
            throw new TelegramWrongResponseException('Telegram request failed! Description: "'
                . $response->getDescription() . '". Error code: ' . $response->getErrorCode());
        }

        return $response;
    }
}
