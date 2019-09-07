<?php

namespace CaliforniaMountainSnake\SocialNetworksAPI\Telegram;

use CaliforniaMountainSnake\SocialNetworksAPI\Telegram\Enums\ParseModeEnum;
use CaliforniaMountainSnake\SocialNetworksAPI\Telegram\Enums\TelegramInputMediaTypesEnum;
use CaliforniaMountainSnake\SocialNetworksAPI\Telegram\Utils\IncludeParseMode;

class InputMedia
{
    use IncludeParseMode;

    /**
     * The field in which must be the mediafile if it is instance of \CURLFile.
     */
    public const MEDIAFILE_FIELD = 'mediafile';

    /**
     * @var TelegramInputMediaTypesEnum
     */
    protected $type;

    /**
     * @var \CURLFile|string
     */
    protected $mediafile;

    /**
     * @var string|null
     */
    protected $caption;

    /**
     * InputMedia constructor.
     *
     * @param TelegramInputMediaTypesEnum $_type
     * @param \CURLFile|string            $_mediafile
     * @param string|null                 $_caption
     * @param ParseModeEnum|null          $_parse_mode
     */
    public function __construct(
        TelegramInputMediaTypesEnum $_type,
        $_mediafile,
        ?string $_caption = null,
        ?ParseModeEnum $_parse_mode = null
    ) {
        $this->type = $_type;
        $this->mediafile = $_mediafile;
        $this->caption = $_caption;
        $this->parseMode = $_parse_mode ?? ParseModeEnum::HTML();
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

        if ($this->mediafile instanceof \CURLFile) {
            $arr['media'] = 'attach://' . self::MEDIAFILE_FIELD;
        }
        if ($this->caption !== null) {
            $arr['caption'] = $this->caption;
            $arr['parse_mode'] = (string)$this->getParseMode();
        }

        return $arr;
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
     * @return \CURLFile|string
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
     * @param \CURLFile|string $mediafile
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
}
