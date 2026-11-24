<?php
class Foo
{
    public function __construct()
    {
        echo 'Call Foo constructor' . PHP_EOL;
    }
}

class Bar extends Foo
{
    //Une constante de classe
    //Attribution de type aux constantes depuis PHP 8.3.0
    const string BAZ = 'baz';
    public function __construct()
    {
        //Appel au constructeur parent (pas appelé automatiquement !)
        //parent::__construct();
        echo 'Call Bar constructor' . PHP_EOL;
    }
}
echo Bar::BAZ . PHP_EOL;
$bar = new Bar();
