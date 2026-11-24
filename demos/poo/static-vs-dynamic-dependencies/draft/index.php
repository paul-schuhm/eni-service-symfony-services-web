<?php

//Demander à l'utilisateur de fournir une forme et une taille en entrée, et le programme va afficher l'aire et le périmètre
//php index.php circle 1

//Dépendance statique
require_once './IGeometry.php';

$shapeRequired = $argv[1];
$length = $argv[2];

//Dépendances dynamiques
//En fonction de la forme demandée, je vais devoir instancier un Circle ou un Square
if ($shapeRequired === 'circle') {
    require_once './Circle.php';
    $shape = new Circle($length);
} else if ($shapeRequired === 'square') {
    require_once './Square.php';
    $shape = new Square($length);
} else {
    echo "Forme inconnue par le système" . PHP_EOL;
    exit;
}
//autowiring (Symfony, Spring)

$perimeter = $shape->perimeter();
$area = $shape->area();

echo $shapeRequired . PHP_EOL;
echo $perimeter . PHP_EOL;
echo $area . PHP_EOL;
