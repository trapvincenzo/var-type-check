# Var type check for Twig
Var type check is a simple tool that checks if the variables passed inside a template meet the required types.

## Example
```twig
... inside the template we declare the requirements

{# this is optional and if defined needs to be a string #}
{% varType title expects string %}

{# this is required and needs to be a int #}
{% varType age expects int required %}
```

## Install
Add to your `AppKernel.php` the following:

```php
$bundles[] = new \Trapvincenzo\Bundle\VarTypeCheckBundle\TrapvincenzoVarTypeCheckBundle();
```
Probably you want to enable this bundle only on `dev` and not in `prod`.

## Create a custom type checker
If you need to add some custom type checker to your app, it needs to implements the `Trapvincenzo\Bundle\VarTypeCheckBundle\Service\Type\TypeCheckerInterface` and the service needs to be tagged with `trapvincenzo.vartypecheck.type_checker`.


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


### Contribute
The bundle is open for improvements, new type checkers and so on!