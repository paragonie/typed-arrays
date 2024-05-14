<?php
declare(strict_types=1);
namespace ParagonIE\TypedArrays;

class BoolArray extends AbstractTypedArray
{
    protected const string SCALAR_TYPE = 'bool';
    public function __construct(bool ...$arguments)
    {
        $this->contents = $arguments;
    }
}
