<?php


namespace Eniams\Notifier\LinkedIn\Option\ShareMedia;

/**
 * @author Smaïne Milianni <contact@smaine.me>
 *
 * @see https://docs.microsoft.com/en-us/linkedin/marketing/integrations/community-management/shares/ugc-post-api#sharemedia Optional Possible value section
 */
final class LandingPageTitle
{
    public const LEARN_MORE = 'LEARN_MORE';
    public const APPLY_NOW = 'APPLY_NOW ';
    public const DOWNLOAD = 'DOWNLOAD';
    public const GET_QUOTE = 'GET_QUOTE';
    public const SIGN_UP = 'SIGN_UP';
    public const SUBSCRIBE = 'SUBSCRIBE ';
    public const REGISTER = 'REGISTER';

    public const ALL = [
        self::LEARN_MORE,
        self::APPLY_NOW,
        self::DOWNLOAD,
        self::GET_QUOTE,
        self::SIGN_UP,
        self::SUBSCRIBE,
        self::REGISTER,
    ];
}
