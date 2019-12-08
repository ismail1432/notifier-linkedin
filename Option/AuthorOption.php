<?php


namespace Eniams\Notifier\LinkedIn\Option;

/**
 * @author Smaïne Milianni <contact@smaine.me>
 */
final class AuthorOption extends AbstractLinkedInOption
{
    public const PERSON = 'person';

    private $author;

    public function __construct(string $value, string $organisation = self::PERSON)
    {
        $this->author = "urn:li:$organisation:$value";
    }

    public function author(): string
    {
        return $this->author;
    }
}
