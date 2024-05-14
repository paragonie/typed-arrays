<?php
declare(strict_types=1);
namespace ParagonIE\TypedArrays;

class ObjectTypedArray extends AbstractTypedArray
{
    protected const string OBJECT_TYPE = 'stdClass';
    protected const string SCALAR_TYPE = 'object';

    public function __construct(object ...$arguments)
    {
        foreach ($arguments as $index => $argument) {
            if (!is_object($argument)) {
                throw new \TypeError("Argument at index {$index} is not an object");
            }
            $type = static::OBJECT_TYPE;
            if (!$argument instanceof $type) {
                throw new \TypeError("Argument at index {$index} is the wrong type");
            }
        }
        $this->contents = $arguments;
    }

    #[\Override]
    public function offsetSet(mixed $offset, mixed $value): void
    {
        $type = static::OBJECT_TYPE;
        if (!$value instanceof $type) {
            throw new \TypeError("Value is the wrong type");
        }
        $this->contents[$offset] = $value;
    }
}
