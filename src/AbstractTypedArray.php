<?php
declare(strict_types=1);
namespace ParagonIE\TypedArrays;

abstract class AbstractTypedArray implements \ArrayAccess
{
    protected array $contents = [];

    protected const string SCALAR_TYPE = 'mixed';

    public function __debugInfo(): array
    {
        return $this->contents;
    }

    #[\Override]
    public function offsetExists(mixed $offset): bool
    {
        return array_key_exists($offset, $this->contents);
    }

    #[\Override]
    public function offsetGet(mixed $offset): mixed
    {
        if (!$this->offsetExists($offset)) {
            throw new \RangeException('Index not found: ' . $offset);
        }
        return $this->contents[$offset];
    }

    #[\Override]
    public function offsetSet(mixed $offset, mixed $value): void
    {
        switch (static::SCALAR_TYPE) {
            case 'mixed':
                break;
            case 'string':
                if (!is_string($value)) {
                    throw new \TypeError('Only ' . static::SCALAR_TYPE . ' types can be assigned');
                }
                break;
            case 'int':
                if (!is_int($value)) {
                    throw new \TypeError('Only ' . static::SCALAR_TYPE . ' types can be assigned');
                }
                break;
            case 'float':
                if (!is_float($value) && !is_int($value)) {
                    throw new \TypeError('Only ' . static::SCALAR_TYPE . ' types can be assigned');
                }
                break;
            case 'bool':
                if (!is_bool($value)) {
                    throw new \TypeError('Only ' . static::SCALAR_TYPE . ' types can be assigned');
                }
                break;
            case 'object':
                if (!is_object($value)) {
                    throw new \TypeError('Only ' . static::SCALAR_TYPE . ' types can be assigned');
                }
                break;
        }
        $this->contents[$offset] = $value;
    }

    #[\Override]
    public function offsetUnset(mixed $offset): void
    {
        if (array_key_exists($offset, $this->contents)) {
            unset($this->contents[$offset]);
        }
    }
}
