<?php
declare(strict_types=1);

function bool⟦⟧(bool ...$args): bool⟦⟧
{
    return new bool⟦⟧(...$args);
}


function float⟦⟧(float ...$args): float⟦⟧
{
    return new float⟦⟧(...$args);
}

function int⟦⟧(int ...$args): int⟦⟧
{
    return new int⟦⟧(...$args);
}

function string⟦⟧(string ...$args): string⟦⟧
{
    return new string⟦⟧(...$args);
}

// Second level deep:

function bool⟦⟧⟦⟧(bool⟦⟧ ...$args): bool⟦⟧⟦⟧
{
    return new bool⟦⟧⟦⟧(...$args);
}


function float⟦⟧⟦⟧(float⟦⟧ ...$args): float⟦⟧⟦⟧
{
    return new float⟦⟧⟦⟧(...$args);
}


function int⟦⟧⟦⟧(int⟦⟧ ...$args): int⟦⟧⟦⟧
{
    return new int⟦⟧⟦⟧(...$args);
}

function string⟦⟧⟦⟧(string⟦⟧ ...$args): string⟦⟧⟦⟧
{
    return new string⟦⟧⟦⟧(...$args);
}
