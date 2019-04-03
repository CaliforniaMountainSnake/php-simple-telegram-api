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
     * @param string $_bot_token
     * @param string $_chat_id
     * @param string $_user_id
     * @return array
     * @throws TelegramWrongResponseException
     */
    public function getChatMember(string $_bot_token, string $_chat_id, string $_user_id): array
    {
        return $this->sendQuery($_bot_token, 'getChatMember', [
            'chat_id' => $_chat_id,
            'user_id' => $_user_id,
        ]);
    }

    /**
     * @param string $_bot_token
     * @param string $_chat_id
     * @param string $_message_id
     * @return array
     * @throws TelegramWrongResponseException
     */
    public function deleteMessage(string $_bot_token, string $_chat_id, string $_message_id): array
    {
        return $this->sendQuery($_bot_token, 'deleteMessage', [
            'chat_id' => $_chat_id,
            'message_id' => $_message_id,
        ]);
    }

    /**
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

        return $this->sendQuery($_bot_token, 'sendMessage', $params);
    }

    /**
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

        return $this->sendQuery($_bot_token, 'sendAudio', $params);
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
        return $this->sendQuery($_bot_token, 'setWebhook', [
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
        return $this->sendQuery($_bot_token, 'setWebhook', [
            'url' => $_webhook_url,
            'certificate' => new \CurlFile ($_certificate_filename),
        ]);
    }

    /**
     * Send query to Telegram BOT API.
     *
     * @param string $_bot_token
     * @param string $_method
     * @param array $_postfields
     *
     * @return array JSON-Decoded Telegram response.
     * @throws TelegramWrongResponseException Выбрасывается, если не удалось распарсить json-ответ Telegram.
     */
    public function sendQuery(string $_bot_token, string $_method, array $_postfields): array
    {
        $telegramResponse = $this->postQuery('https://api.telegram.org/bot'
            . $_bot_token . '/' . $_method, $_postfields);

        //@TODO: Replace it with JsonException in PHP 7.3
        $telegramResponseJson = $telegramResponse->jsonDecode();
        if (\json_last_error() === \JSON_ERROR_NONE) {
            return $telegramResponseJson;
        }

        throw new TelegramWrongResponseException ("Can't parse Telegram's json response! Code: "
            . $telegramResponse->getCode() . '. Content: "'
            . $telegramResponse->getContent() . '"', $telegramResponse->getCode());
    }
}
