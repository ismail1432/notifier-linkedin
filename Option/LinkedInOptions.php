<?php


namespace Eniams\Notifier\LinkedIn\Option;

use Eniams\Notifier\LinkedIn\Option\ShareContent\ShareContentOption;
use Symfony\Component\Notifier\Message\MessageOptionsInterface;
use Symfony\Component\Notifier\Notification\Notification;

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

    public static function fromNotification(Notification $notification): self
    {
        $options = new self();
        $options->specificContent((new ShareContentOption($notification->getSubject())));

        if ($notification->getContent()) {
            $options->specificContent((new ShareContentOption($notification->getContent())));
        }

        $options->visibility((new VisibilityOption()));
        $options->lifecycleState((new LifecycleStateOption()));

        return $options;
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
    public function lifecycleState(LifecycleStateOption $lifecycleStateOption): self
    {
        $this->options['lifecycleState'] = $lifecycleStateOption->lifecycleState();

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
    public function specificContent(ShareContentOption $specificContent): self
    {
        $this->options['specificContent']['com.linkedin.ugc.ShareContent'] = $specificContent->toArray();

        return $this;
    }

    public function author(AuthorOption $authorOption): self
    {
        $this->options['author'] = $authorOption->author();

        return $this;
    }

    public function visibility(VisibilityOption $visibilityOption): self
    {
        $this->options['visibility'] = $visibilityOption->toArray();

        return $this;
    }
}
