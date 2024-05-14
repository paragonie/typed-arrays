<?php
declare(strict_types=1);
namespace ParagonIE\TypedArrays;

class IntArray extends AbstractTypedArray
{
    protected const string SCALAR_TYPE = 'int';

    public function __construct(int ...$arguments)
    {
        $this->contents = $arguments;
    }
}
