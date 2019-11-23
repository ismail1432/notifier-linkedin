<?php

namespace Eniams\Notifier\LinkedIn\Option;

use Eniams\Notifier\LinkedIn\Exception\UndefinedLifeCycleOption;

/**
 * @author Smaïne Milianni <contact@smaine.me>
 *
 * @see https://docs.microsoft.com/en-us/linkedin/marketing/integrations/community-management/shares/ugc-post-api#schema lifecycleState section
 */
final class LifecycleStateOption extends AbstractLinkedInOption
{
    public const DRAFT = 'DRAFT';
    public const PUBLISHED = 'PUBLISHED';
    public const PROCESSING = 'PROCESSING';
    public const PROCESSING_FAILED = 'PROCESSING_FAILED';
    public const DELETED = 'DELETED';
    public const PUBLISHED_EDITED = 'PUBLISHED_EDITED';

    private const AVAILABLE_LIFECYCLE = [
        self::DRAFT,
        self::PUBLISHED,
        self::PROCESSING_FAILED,
        self::DELETED,
        self::PROCESSING_FAILED,
        self::PUBLISHED_EDITED,
    ];

    private $lifecycleState;

    public function __construct(string $lifecycleState = self::PUBLISHED)
    {
        if (!\in_array($lifecycleState, self::AVAILABLE_LIFECYCLE)) {
            throw new UndefinedLifeCycleOption(sprintf("%s is not a valid value, available lifecycle are %s", $lifecycleState, implode(", ", self::AVAILABLE_LIFECYCLE)));
        }

        $this->lifecycleState = $lifecycleState;
    }

    public function lifecycleState(): string
    {
        return $this->lifecycleState;
    }
}
