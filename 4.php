<?php

#[Attribute]
class MyAttribute
{
    public function __construct(public string $value)
    {
    }
}

class MyClass
{
    #[MyAttribute('Attribute 1')]
    public function method1()
    {
        echo 'Method 1';
    }

    #[MyAttribute('Attribute 2')]
    public function method2()
    {
        echo 'Method 2';
    }
}

$reflectionClass = new ReflectionClass('MyClass');

foreach ($reflectionClass->getMethods() as $method) {
    $attributes = $method->getAttributes('MyAttribute');

    if (!empty($attributes)) {
        echo 'Method ' . $method->getName() . ' has MyAttribute:<br>';
        foreach ($attributes as $attribute) {
            echo $attribute->newInstance()->value . '<br>';
        }
    } else {
        echo 'Method ' . $method->getName() . ' does not have MyAttribute<br>';
    }
}