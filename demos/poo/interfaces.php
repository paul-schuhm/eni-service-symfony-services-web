<?php
interface SomeOperation{
    function process();
}
class Foo implements SomeOperation{
    function process(){echo 'Processing with Foo procedure...';}
}
class Bar implements SomeOperation{
    function process(){echo 'Processing with Bar procedure...';}
}
//le message 'process' est envoyé à un objet Foo, il fait un traitement
new Foo()->process();
//le MÊME message 'process' est envoyé à un objet Bar, il fait un AUTRE traitement
new Bar()->process();
