<?php


namespace Eniams\Notifier\LinkedIn;

use Symfony\Component\Notifier\Message\MessageOptionsInterface;

/**
 * @author Smaïne Milianni <contact@smaine.me>
 */
final class LinkedInOptions implements MessageOptionsInterface
{
    private $options = [];

    public function __construct(array $options = [])
    {
        $this->options = $options;
    }

    public function toArray(): array
    {
        return $this->options;
    }

    public function getRecipientId(): ?string
    {
    }

    /**
     * @return $this
     */
    public function contentCertificationRecord(string $contentCertificationRecord): self
    {
        $this->options['contentCertificationRecord'] = $contentCertificationRecord;

        return $this;
    }

    /**
     * @return $this
     */
    public function firstPublishedAt(int $firstPublishedAt): self
    {
        $this->options['firstPublishedAt'] = $firstPublishedAt;

        return $this;
    }

    /**
     * @return $this
     */
    public function lifecycleState(string $lifecycleState): self
    {
        $this->options['lifecycleState'] = $lifecycleState;

        return $this;
    }

    /**
     * @return $this
     */
    public function origin(string $origin): self
    {
        $this->options['origin'] = $origin;

        return $this;
    }

    /**
     * @return $this
     */
    public function ugcOrigin(string $ugcOrigin): self
    {
        $this->options['ugcOrigin'] = $ugcOrigin;

        return $this;
    }

    /**
     * @return $this
     */
    public function versionTag(string $versionTag): self
    {
        $this->options['versionTag'] = $versionTag;

        return $this;
    }

    /**
     * @return $this
     */
    public function visibility(string $visibility): self
    {
        $this->options['visibility'] = $visibility;

        return $this;
    }
}
