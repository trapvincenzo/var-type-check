# Var type check for Twig
With var type check, is easy to create a list of requirements that the vars passed into a template must meet.

## DSL
The structure of the check is really simple and expressive

`varType` **nameOfTheVariable** `expects` **type** `required (optional, the default is false)`

## Example
```twig
... inside the template we declare the requirements

{# this is optional and if defined needs to be a string #}
{% varType title expects string %}

{# this is required and needs to be a int #}
{% varType age expects int required %}
```

## Structure definition
Some types allow to define a structure of types using the word `of` followed by an object.

```twig
... inside the template we declare the requirements

{% varType data expects array of {title: {type: 'string', required: true}, desc: {type: 'string'}} %}
```

## Available checkers

| Checker   | Type       |  Allow structure  |
| -------   | :------:   | :----------------:|
| `array`   | Array      |  Yes              |
| `bool`    | Bool       |  No               |
| `float`   | Float      |  No               |
| `int`     | Integer    |  No               |
| `numeric` | Numeric    |  No               |
| `object`  | Object     |  Yes              |
| `string`  | String     |  No               |

## Install
Add to your `AppKernel.php` the following:

```php
$bundles[] = new \Trapvincenzo\Bundle\VarTypeCheckBundle\TrapvincenzoVarTypeCheckBundle();
```
Probably you want to enable this bundle only on `dev` and not in `prod`.

## Create a custom type checker
If you need to add some custom type checker to your app, it needs to implement the `Trapvincenzo\Bundle\VarTypeCheckBundle\Service\Type\TypeCheckerInterface` and the service must be tagged with `trapvincenzo.vartypecheck.type_checker`.


```php
class CustomTypeChecker implements TypeCheckerInterface
{
 ...
}

```

```yml
services:
  vartypecheck.typer_checker_custom:
     class: CustomTypeChecker
     tags:
         - { name: trapvincenzo.vartypecheck.type_checker }
```

## License Copyright (c) 2017 Vincenzo Trapani

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

## Contribute
The bundle is open for improvements, new type checkers and so on!