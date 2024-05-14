<?php
declare(strict_types=1);
namespace ParagonIE\TypedArrays;

class StringArray extends AbstractTypedArray
{
    protected const string SCALAR_TYPE = 'string';

    public function __construct(string ...$arguments)
    {
        $this->contents = $arguments;
    }
}
