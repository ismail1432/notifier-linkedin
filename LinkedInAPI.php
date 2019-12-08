<?php

namespace Eniams\Notifier\LinkedIn;

/**
 * @author Smaïne Milianni <contact@smaine.me>
 */
final class LinkedInAPI
{
    public const HOST = 'api.linkedin.com';
    public const PROTOCOL_VERSION = '2.0.0';
    public const PROTOCOL_HEADER = 'X-Restli-Protocol-Version';
    public const ENDPOINT = 'https://api.linkedin.com/v2/ugcPosts';
}
