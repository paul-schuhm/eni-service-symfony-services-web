<?php
//Foo possède une méthode abstraite, elle est donc abstraite
class Foo{
    protected int $foo;
    //foo n'est pas implémentée, seule la signature est définie
    abstract public function foo():int;
    //bar() est implémentée
    public function bar(){echo 'bar' . PHP_EOL;}
}

class Bar extends Foo{
    //Bar définit l'implémentation de la méthode abstraite foo, en respectant sa signature
    public function foo():int {
        echo 'Implémentation de foo dans la classe Bar' . PHP_EOL;
        return 10;
    }
}
$bar = new Bar();
echo $bar->foo() . PHP_EOL;
$bar->bar() . PHP_EOL;
