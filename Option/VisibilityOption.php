<?php


namespace Eniams\Notifier\LinkedIn\Option;

use Eniams\Notifier\LinkedIn\Exception\UndefinedVisibilityOption;

/**
 * @author Smaïne Milianni <contact@smaine.me>
 *
 * @see https://docs.microsoft.com/en-us/linkedin/marketing/integrations/community-management/shares/ugc-post-api#sharemedia visibility section
 */
final class VisibilityOption extends AbstractLinkedInOption
{
    public const MEMBER_NETWORK_VISIBILITY = 'MemberNetworkVisibility';
    public const SPONSORED_CONTENT_VISIBILITY = 'SponsoredContentVisibility';

    public const CONNECTIONS = 'CONNECTIONS';
    public const PUBLIC = 'PUBLIC';
    public const LOGGED_IN = 'LOGGED_IN';
    public const DARK = 'DARK';

    private const MEMBER_NETWORK = [
        self::CONNECTIONS,
        self::PUBLIC,
        self::LOGGED_IN
    ];

    private const AVAILABLE_VISIBILITY = [
        self::MEMBER_NETWORK_VISIBILITY,
        self::SPONSORED_CONTENT_VISIBILITY
    ];

    public function __construct(string $visibility = self::MEMBER_NETWORK_VISIBILITY, string $value = 'PUBLIC')
    {
        if (!\in_array($visibility, self::AVAILABLE_VISIBILITY)) {
            throw new UndefinedVisibilityOption(sprintf("%s is not a valid visibility, available visibility are %s", $visibility, implode(", ", self::AVAILABLE_VISIBILITY)));
        }

        if (self::MEMBER_NETWORK_VISIBILITY === $visibility && !\in_array($value, self::MEMBER_NETWORK)) {
            throw new UndefinedVisibilityOption(sprintf("%s is not a valid value, available value for visibility %s are %s", $value, $visibility, implode(", ", self::MEMBER_NETWORK)));
        }

        if (self::SPONSORED_CONTENT_VISIBILITY === $visibility && $value !== self::DARK) {
            throw new UndefinedVisibilityOption(sprintf("%s is not a valid value, available value for visibility %s is %s", $value, $visibility, self::DARK));
        }

        $this->options['com.linkedin.ugc.'.$visibility] = $value;
    }
}
