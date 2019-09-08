<?php

namespace CaliforniaMountainSnake\SocialNetworksAPI\Telegram\Utils;

use CaliforniaMountainSnake\SocialNetworksAPI\Telegram\Enums\MessageEntityTypesEnum;

trait MessageEntitiesUtils
{
    /**
     * Covert message entities to html (or other preset), if the message contains text/caption with entities.
     *
     * @param array         $_telegram_message_raw      Telegram message object.
     * @param callable|null $_url_href_replace_callback The callback that replace href of the each url.
     * @param array|null    $_preset                    Entities replace preset.
     *
     * @return string|null Converted text/caption or null if the message doesn't have a text/caption.
     */
    public function getTelegramMessageTextWithEntities(
        array $_telegram_message_raw,
        callable $_url_href_replace_callback = null,
        array $_preset = null
    ): ?string {
        // Get data.
        $preset = $_preset ?? $this->getHtmlEntitiesPreset();
        $entities = $_telegram_message_raw['entities'] ?? $_telegram_message_raw['caption_entities'] ?? [];
        $text = $_telegram_message_raw['text'] ?? $_telegram_message_raw['caption'] ?? null;
        empty($text) && $text = null;

        // Telegram sends offsets in UTF-16 code units to the start of the entity.
        $iterationText = $text;
        $globalDiff = 0;
        foreach ($entities as $entity) {
            // Get entity's info.
            $type = $entity['type'];
            $length = $entity['length'];
            $offset = $entity['offset'] + $globalDiff;
            if (!isset ($preset[$type])) {
                continue;
            }

            // Get positions.
            $pBefore = \mb_substr($iterationText, 0, $offset);
            $pText = \mb_substr($iterationText, $offset, $length);
            $pAfter = \mb_substr($iterationText, $offset + $length);

            // Get pattern from the preset.
            $content = $preset[$type];

            // First, replace url, in that rare case, if in the text will be the %text macros.
            if ($type === MessageEntityTypesEnum::TEXT_LINK) {
                $urlHref = $entity['url'];

                // Replace url's href to the user's one.
                $_url_href_replace_callback !== null && $urlHref = $_url_href_replace_callback ($urlHref);

                // Insert the url's href to the preset.
                $content = \str_replace('%url', $urlHref, $content);
            }

            // Replace main text.
            $content = \str_replace('%text', $pText, $content);

            $newText = $pBefore . $content . $pAfter;
            $globalDiff += (\mb_strlen($newText) - \mb_strlen($iterationText));
            $iterationText = $newText;
        }

        return $iterationText;
    }

    /**
     * @return array
     */
    protected function getHtmlEntitiesPreset(): array
    {
        return [
            MessageEntityTypesEnum::BOLD => '<b>%text</b>',
            MessageEntityTypesEnum::ITALIC => '<i>%text</i>',
            MessageEntityTypesEnum::TEXT_LINK => '<a href="%url">%text</a>',
            MessageEntityTypesEnum::CODE => '<code>%text</code>',
            MessageEntityTypesEnum::PRE => '<pre>%text</pre>',
        ];
    }

    /**
     * @return array
     */
    protected function getMarkdownEntitiesPreset(): array
    {
        return [
            MessageEntityTypesEnum::BOLD => '*%text*',
            MessageEntityTypesEnum::ITALIC => '_%text_',
            MessageEntityTypesEnum::TEXT_LINK => '[%text](%url)',
            MessageEntityTypesEnum::CODE => '`%text`',
            MessageEntityTypesEnum::PRE => '```%text' . "\n" . '```',
        ];
    }
}
