<?php

namespace CaliforniaMountainSnake\SocialNetworksAPI\Telegram;

use CaliforniaMountainSnake\SocialNetworksAPI\Telegram\Enums\ParseModeEnum;
use CaliforniaMountainSnake\SocialNetworksAPI\Telegram\Enums\TelegramInputMediaTypesEnum;
use CaliforniaMountainSnake\SocialNetworksAPI\Telegram\Utils\ParseModeUtils;

class InputMedia
{
    use ParseModeUtils;

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
    protected $media;

    /**
     * @var string|null
     */
    protected $caption;

    /**
     * InputMedia constructor.
     *
     * @param TelegramInputMediaTypesEnum $type
     * @param \CURLFile|string            $media
     * @param string|null                 $caption
     * @param ParseModeEnum|null          $_parse_mode
     */
    public function __construct(
        TelegramInputMediaTypesEnum $type,
        $media,
        ?string $caption = null,
        ?ParseModeEnum $_parse_mode = null
    ) {
        $this->type = $type;
        $this->media = $media;
        $this->caption = $caption;
        $this->parseMode = $_parse_mode;
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
            'media' => $this->media,
            'parse_mode' => (string)$this->getParseMode(),
        ];

        if ($this->media instanceof \CURLFile) {
            $arr['media'] = 'attach://' . self::MEDIAFILE_FIELD;
        }
        if ($this->caption !== null) {
            $arr['caption'] = $this->caption;
        }

        return $arr;
    }

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
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * @return string|null
     */
    public function getCaption(): ?string
    {
        return $this->caption;
    }
}
