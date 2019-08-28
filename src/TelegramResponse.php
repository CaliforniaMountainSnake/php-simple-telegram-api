<?php

namespace CaliforniaMountainSnake\SocialNetworksAPI\Telegram;

/**
 * Represents the telegram response.
 */
class TelegramResponse implements \Countable, \ArrayAccess
{
    /**
     * @var array
     */
    protected $container;

    /**
     * TelegramResponse constructor.
     *
     * @param array $_telegram_raw_response
     */
    public function __construct(array $_telegram_raw_response)
    {
        $this->container = $_telegram_raw_response;
    }

    /**
     * @return bool
     */
    public function isOk(): bool
    {
        return (isset ($this->container['ok']) && \filter_var($this->container['ok'], \FILTER_VALIDATE_BOOLEAN));
    }

    /**
     * @param string[] $_extra_keys
     *
     * @return mixed
     */
    public function getResult(string ...$_extra_keys)
    {
        $result = $this->container['result'];
        foreach ($_extra_keys as $key) {
            $result = $result[$key];
        }

        return $result;
    }

    /**
     * Get the description if it exists.
     *
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->container['description'] ?? null;
    }

    /**
     * Get the error_code if it exists.
     *
     * @return int|null
     */
    public function getErrorCode(): ?int
    {
        return $this->container['error_code'] ?? null;
    }

    //------------------------------------------------------------------------------------------------------------------

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string)\json_encode($this->container);
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->container;
    }

    //------------------------------------------------------------------------------------------------------------------
    // Realisation of interfaces.
    //------------------------------------------------------------------------------------------------------------------

    /**
     * Count elements of an object
     *
     * @link  https://php.net/manual/en/countable.count.php
     * @return int The custom count as an integer.
     *
     * The return value is cast to an integer.
     * @since 5.1.0
     */
    public function count(): int
    {
        return \count($this->container);
    }

    /**
     * Whether a offset exists
     *
     * @link  https://php.net/manual/en/arrayaccess.offsetexists.php
     *
     * @param mixed $offset An offset to check for.
     *
     * @return boolean true on success or false on failure.
     * The return value will be casted to boolean if non-boolean was returned.
     * @since 5.0.0
     */
    public function offsetExists($offset): bool
    {
        return isset($this->container[$offset]);
    }

    /**
     * Offset to retrieve
     *
     * @link  https://php.net/manual/en/arrayaccess.offsetget.php
     *
     * @param mixed $offset The offset to retrieve.
     *
     * @return mixed Can return all value types.
     * @since 5.0.0
     */
    public function offsetGet($offset)
    {
        return $this->container[$offset];
    }

    /**
     * Offset to set
     *
     * @link  https://php.net/manual/en/arrayaccess.offsetset.php
     *
     * @param mixed $offset The offset to assign the value to.
     * @param mixed $value  The value to set.
     *
     * @return void
     * @since 5.0.0
     */
    public function offsetSet($offset, $value): void
    {
        $this->container[$offset] = $value;
    }

    /**
     * Offset to unset
     *
     * @link  https://php.net/manual/en/arrayaccess.offsetunset.php
     *
     * @param mixed $offset The offset to unset.
     *
     * @return void
     * @since 5.0.0
     */
    public function offsetUnset($offset): void
    {
        unset ($this->container[$offset]);
    }
}
