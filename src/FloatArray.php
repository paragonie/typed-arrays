<?php
declare(strict_types=1);
namespace ParagonIE\TypedArrays;

class FloatArray extends AbstractTypedArray
{
    protected const string SCALAR_TYPE = 'float';

    public function __construct(float ...$arguments)
    {
        $this->contents = $arguments;
    }
}
