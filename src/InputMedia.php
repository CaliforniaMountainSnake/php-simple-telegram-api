<?php

namespace CaliforniaMountainSnake\SocialNetworksAPI\Telegram;

use CaliforniaMountainSnake\SocialNetworksAPI\Telegram\Enums\ParseModeEnum;
use CaliforniaMountainSnake\SocialNetworksAPI\Telegram\Enums\TelegramInputMediaTypesEnum;
use CaliforniaMountainSnake\SocialNetworksAPI\Telegram\Utils\IncludeParseMode;
use CURLFile;

class InputMedia
{
    use IncludeParseMode;

    /**
     * The field in which must be the mediafile if it is instance of \CURLFile.
     */
    public const DEFAULT_MEDIAFILE_FIELD = 'mediafile';

    /**
     * @var TelegramInputMediaTypesEnum
     */
    protected $type;

    /**
     * @var CURLFile|string
     */
    protected $mediafile;

    /**
     * @var string|null
     */
    protected $caption;

    /**
     * @var string
     */
    protected $attachMediafileField;

    /**
     * InputMedia constructor.
     *
     * @param TelegramInputMediaTypesEnum $_type
     * @param CURLFile|string             $_mediafile
     * @param string|null                 $_caption
     * @param ParseModeEnum|null          $_parse_mode
     * @param string|null                 $_attach_mediafile_field
     */
    public function __construct(
        TelegramInputMediaTypesEnum $_type,
        $_mediafile,
        ?string $_caption = null,
        ?ParseModeEnum $_parse_mode = null,
        ?string $_attach_mediafile_field = null
    ) {
        $this->type = $_type;
        $this->mediafile = $_mediafile;
        $this->caption = $_caption;
        $this->parseMode = $_parse_mode ?? ParseModeEnum::HTML();
        $this->attachMediafileField = $_attach_mediafile_field ?? self::DEFAULT_MEDIAFILE_FIELD;
    }

    //------------------------------------------------------------------------------------------------------------------

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }

    /**
     * @return string
     */
    public function toJson(): string
    {
        return \json_encode($this->toArray());
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $arr = [
            'type' => (string)$this->type,
            'media' => $this->mediafile,
        ];

        if ($this->mediafile instanceof CURLFile) {
            $arr['media'] = 'attach://' . $this->attachMediafileField;
        }
        if ($this->caption !== null) {
            $arr['caption'] = $this->caption;
            $arr['parse_mode'] = (string)$this->getParseMode();
        }

        return $arr;
    }

    /**
     * @param array        $_params     Array with query params.
     * @param string       $_param_name The parameter name in which data will be injected.
     * @param InputMedia[] $_mediafiles
     *
     * @see https://core.telegram.org/bots/api#inputmediaphoto
     */
    public static function injectIntoQuery(array &$_params, string $_param_name, InputMedia ...$_mediafiles): void
    {
        $mediaJsons = [];
        foreach ($_mediafiles as $mediafile) {
            $rawMedia = $mediafile->getMediafile();

            // Inject raw file into the params.
            if ($rawMedia instanceof CURLFile) {
                $_params[$mediafile->getAttachMediafileField()] = $rawMedia;
            }

            // Add mediafile's json to array.
            $mediaJsons[] = $mediafile->toJson();
        }

        $_params[$_param_name] = $mediaJsons;
        if (count($mediaJsons) === 1) {
            $_params[$_param_name] = $mediaJsons[0];
        }
    }

    //------------------------------------------------------------------------------------------------------------------
    // Getters.
    //------------------------------------------------------------------------------------------------------------------

    /**
     * @return TelegramInputMediaTypesEnum
     */
    public function getType(): TelegramInputMediaTypesEnum
    {
        return $this->type;
    }

    /**
     * @return CURLFile|string
     */
    public function getMediafile()
    {
        return $this->mediafile;
    }

    /**
     * @return string|null
     */
    public function getCaption(): ?string
    {
        return $this->caption;
    }

    /**
     * @return string
     */
    public function getAttachMediafileField(): string
    {
        return $this->attachMediafileField;
    }

    //------------------------------------------------------------------------------------------------------------------
    // Setters.
    //------------------------------------------------------------------------------------------------------------------

    /**
     * @param TelegramInputMediaTypesEnum $type
     */
    public function setType(TelegramInputMediaTypesEnum $type): void
    {
        $this->type = $type;
    }

    /**
     * @param CURLFile|string $mediafile
     */
    public function setMediafile($mediafile): void
    {
        $this->mediafile = $mediafile;
    }

    /**
     * @param string|null $caption
     */
    public function setCaption(?string $caption): void
    {
        $this->caption = $caption;
    }

    /**
     * @param string $attachMediafileField
     */
    public function setAttachMediafileField(string $attachMediafileField): void
    {
        $this->attachMediafileField = $attachMediafileField;
    }
}
