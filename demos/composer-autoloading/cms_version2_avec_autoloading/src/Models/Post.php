<?php

namespace Ps\App\Models;

use JsonSerializable; // import de la classe globale (@see https://www.php.net/manual/en/class.jsonserializable.php)
use DateTimeImmutable;
use DateTimeInterface;

class Post implements JsonSerializable
{
    //Une variable de classe (static)
    private static int $last_id = 1;

    public readonly int $id;

    public function __construct(
        readonly public string $slug,
        readonly public string $title,
        //Je ne respecte pas ici la même convention de casse (on fixera cela après avec un linter)
        readonly public DateTimeImmutable $date_publication,
        readonly public int $author,
        ?int $id = null,
    ) {
        //Opérateur null coealescing : équivalent à $this->id = isset($id) ? $id : static::$last_id;
        $this->id = $id ?? self::$last_id;
        self::$last_id++;
    }
    
    public function jsonSerialize(): array
    {
        return [
            'id'               => $this->id,
            'title'            => $this->title,
            'slug'             => $this->slug,
            'url'              => '/' . $this->slug,
            'date_publication' => $this->date_publication->format(DateTimeInterface::ATOM), // DATE_ATOM (alias de DateTimeInterface::ATOM, Y-m-d\TH:i:sP)
            'author'           => $this->author,
        ];
    }
}
