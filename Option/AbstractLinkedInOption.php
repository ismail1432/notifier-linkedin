<?php


namespace Eniams\Notifier\LinkedIn\Option;

/**
 * @author Smaïne Milianni <contact@smaine.me>
 */
abstract class AbstractLinkedInOption implements LinkedInOptionInterface
{
    protected $options = [];

    public function toArray(): array
    {
        return $this->options;
    }
}
