<?php
namespace GuzzleHttp;

/**
 * Trait implementing ToArrayInterface, \ArrayAccess, \Countable,
 * \IteratorAggregate, and some path style methods.
 */
trait HasDataTrait
{
    /** @var array */
    protected $data = [];

    public function getIterator() : \Iterator
    {
        return new \ArrayIterator($this->data);
    }

    public function offsetGet($offset)
    {
        return isset($this->data[$offset]) ? $this->data[$offset] : null;
    }

    public function offsetSet($offset, $value) : void
    {
        $this->data[$offset] = $value;
    }

    public function offsetExists($offset) : bool
    {
        return isset($this->data[$offset]);
    }

    public function offsetUnset($offset) : void
    {
        unset($this->data[$offset]);
    }

    public function toArray() : array
    {
        return $this->data;
    }

    public function count() : int
    {
        return count($this->data);
    }

    /**
     * Get a value from the collection using a path syntax to retrieve nested
     * data.
     *
     * @param string $path Path to traverse and retrieve a value from
     *
     * @return mixed|null
     */
    public function getPath($path)
    {
        return Utils::getPath($this->data, $path);
    }

    /**
     * Set a value into a nested array key. Keys will be created as needed to
     * set the value.
     *
     * @param string $path  Path to set
     * @param mixed  $value Value to set at the key
     *
     * @throws \RuntimeException when trying to setPath using a nested path
     *     that travels through a scalar value
     */
    public function setPath($path, $value)
    {
        Utils::setPath($this->data, $path, $value);
    }
}
