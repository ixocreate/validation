<?php
namespace KiwiSuite\Validation\Violation;

final class Violation implements \JsonSerializable, \ArrayAccess
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $error;
    /**
     * @var string
     */
    private $message;

    /**
     * @param string $name
     * @param string $error
     * @param string|null $message
     */
    public function __construct(string $name, string $error, string $message = null)
    {
        $this->name = $name;
        $this->error = $error;
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function error(): string
    {
        return $this->error;
    }

    /**
     * @return null|string
     */
    public function message(): ?string
    {
        return $this->message;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'error' => $this->error(),
            'message' => $this->message(),
        ];
    }

    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return in_array($offset, ['name', 'error', 'message']);
    }

    /**
     * @param mixed $offset
     * @return mixed|void
     * @throws \Exception
     */
    public function offsetGet($offset)
    {
        if (!$this->offsetExists($offset)) {
            throw new \Exception("Can't access this property");
        }
        return $this->{$offset};
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        throw new \BadMethodCallException("Setting values not allowed");
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        throw new \BadMethodCallException("Unsetting values not allowed");
    }
}