<?php

declare(strict_types=1);

class Foo{
    private string $baz = "attribute defined in class Foo";
    public function foo(){ echo 'foo() called. Show private attribute $baz is evaluated to ' . $this->baz . PHP_EOL;}
    public function baz(){
        echo $this->baz . PHP_EOL;
    }
}
/* Bar étend Foo, Bar est une classe enfant de Foo
La propriété $baz existe dans l'objet mais reste inaccessible depuis Bar (private). */
class Bar extends Foo{
  //Bar dispose des méthodes foo() et baz()
  //On peut masquer ('override') une méthode parente dans la classe enfant
  
  #[Override]
  public function baz(){
    parent::baz();
    echo "things added by Bar..." . PHP_EOL;
  }
}
new Bar()->baz();
new Bar()->foo();
