# Strictly Typed Arrays in PHP 8

[![Build Status](https://github.com/paragonie/typed-arrays/actions/workflows/ci.yml/badge.svg)](https://github.com/paragonie/typed-arrays/actions)
[![Latest Stable Version](https://poser.pugx.org/paragonie/typed-arrays/v/stable)](https://packagist.org/packages/paragonie/typed-arrays)
[![Latest Unstable Version](https://poser.pugx.org/paragonie/typed-arrays/v/unstable)](https://packagist.org/packages/paragonie/typed-arrays)
[![License](https://poser.pugx.org/paragonie/typed-arrays/license)](https://packagist.org/packages/paragonie/typed-arrays)
[![Downloads](https://img.shields.io/packagist/dt/paragonie/typed-arrays.svg)](https://packagist.org/packages/paragonie/typed-arrays)

**Requires PHP 8.3**. This is best described through example:

```php
<?php
require_once 'vendor/autoload.php';

class Foo
{
    public function __construct(
        public readonly string⟦⟧ $foo,
        public readonly int⟦⟧ $bar
    ) {}
}

$x = new Foo(
    string⟦⟧('apple', 'bee'),
    int⟦⟧(4, 5, 120000),
);
var_dump($x->foo, $x->bar);
var_dump($x->foo[1]);
```

This should output the following:

```
object(string⟦⟧)#5 (2) {
  [0]=>
  string(5) "apple"
  [1]=>
  string(3) "bee"
}
object(int⟦⟧)#6 (3) {
  [0]=>
  int(4)
  [1]=>
  int(5)
  [2]=>
  int(120000)
}
string(3) "bee"
```

If you try to pass an incorrect type, you'll get a `TypeError`:

```php
<?php
declare(strict_types=1);
require_once 'vendor/autoload.php';

class Foo
{
    public function __construct(
        public readonly string⟦⟧ $foo
    ) {}
}

$x = new Foo(
    string⟦⟧('apple', 'bee', 25)
);
var_dump($x->foo, $x->bar);
```

Should produce:

```terminal
Fatal error: Uncaught TypeError: string⟦⟧(): Argument #3 must be of type string, int given
```

## What Is This Package Doing?

We are using Unicode characters (`⟦` and `⟧`) to create a class that implements `ArrayAccess`.
All arguments to these types are then strictly typed.

In effect, we have turned a class into a typed array that your IDE will not complain about.

## Does It Support Multi-Level Types? e.g. `string⟦⟧⟦⟧`

You betcha.

```php
<?php
declare(strict_types=1);
require_once 'vendor/autoload.php';

class Bar
{
    public function __construct(
        public readonly string⟦⟧⟦⟧ $double,
    ) {}
}

$test = new Bar(string⟦⟧⟦⟧(
    string⟦⟧('test'),
    string⟦⟧('example'),
));
var_dump($test->double);
```

This will produce:

```terminal
object(string⟦⟧⟦⟧)#7 (2) {
  [0]=>
  object(string⟦⟧)#5 (1) {
    [0]=>
    string(4) "test"
  }
  [1]=>
  object(string⟦⟧)#6 (1) {
    [0]=>
    string(7) "example"
  }
}
```

## Does This Support Arrays of Classes?

Of course!

```php
<?php
declare(strict_types=1);
require_once 'vendor/autoload.php';

class Foo {}

class Bar
{
    public function __construct(
        public readonly Foo⟦⟧ $example
    ) {}
}

$test = new Bar(new Foo⟦⟧(new Foo));
var_dump($test);
```

Output:

```terminal
object(Bar)#2 (1) {
  ["example"]=>
  object(Foo⟦⟧)#5 (1) {
    [0]=>
    object(Foo)#6 (0) {
    }
  }
}
```

### How Does This Create Types for My Classes?

See: [the autoloader](global/autoloader.php).

