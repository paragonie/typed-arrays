<?php
declare(strict_types=1);
namespace ParagonIE\TypedArrays\Tests;

use PHPUnit\Framework\TestCase;
use ParagonIE\TypedArrays\{
    AbstractTypedArray,
    BoolArray,
    FloatArray,
    IntArray,
    StringArray
};
use function bool⟦⟧, float⟦⟧, int⟦⟧, string⟦⟧;

/**
 * @covers AbstractTypedArray
 */
class BasicTest extends TestCase
{
    public function testBasic()
    {
        $bools = bool⟦⟧(true, false);
        $ints = int⟦⟧(1, 2, 3);
        $floats = float⟦⟧(1.618, M_E, M_PI);
        $strings = string⟦⟧('a', 'b', 'c');

        $this->assertInstanceOf(BoolArray::class, $bools);
        $this->assertInstanceOf(FloatArray::class, $floats);
        $this->assertInstanceOf(IntArray::class, $ints);
        $this->assertInstanceOf(StringArray::class, $strings);

        $this->assertIsBool($bools[0]);
        $this->assertIsFloat($floats[0]);
        $this->assertIsInt($ints[0]);
        $this->assertIsString($strings[0]);
    }
}