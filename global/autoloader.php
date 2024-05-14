<?php
declare(strict_types=1);

use ParagonIE\TypedArrays\ObjectTypedArray;

// Load all the wrappers for scalar type
require_once __DIR__ . '/bool-array.php';
require_once __DIR__ . '/float-array.php';
require_once __DIR__ . '/int-array.php';
require_once __DIR__ . '/string-array.php';
require_once __DIR__ . '/double-array.php';
require_once __DIR__ . '/functions.php';

spl_autoload_register(function (string $class_name) {
    /* Security note: This will not allow escape characters, so the eval() below should be ok. */
    if (!preg_match('#([A-Za-z0-9\\\\]+)(⟦⟧+)$#', $class_name, $m)) {
        // We are only interested in autoloading typed arrays
        return false;
    }
    switch ($m[1]) {
        case 'string':
        case 'int':
        case 'float':
        case 'bool':
            // These wre autoloaded above!
            return false;
        default:
            if (!class_exists($m[1]) && !interface_exists($m[1])) {
                return false;
            }
    }

    // Okay, now let's generate the type container at runtime.
    $depth = mb_str_split($m[2], 2, 'utf-8');
    $composite = $m[1];
    for ($i = 0; $i < count($depth); ++$i) {
        if (!class_exists($composite . '⟦⟧', false)) {
            // Class definition
            $exec = "class {$composite}⟦⟧ extends " . ObjectTypedArray::class .
                "\n{\n" .
                "    protected const string OBJECT_TYPE = '{$composite}';\n" .
                "}\n\n";
            // Function helper
            $exec .= "function {$composite}⟦⟧({$composite} ...\$args): {$composite}⟦⟧\n" .
                "{\n" .
                "    return new {$composite}⟦⟧(...\$args);\n" .
                "}\n\n";
            /* We may want to consider dumping to a file instead of just executing. */
            eval($exec);
        }
        $composite .= '⟦⟧';
    }
    // For performance, you're going to want to use opcache
    return true;
});
