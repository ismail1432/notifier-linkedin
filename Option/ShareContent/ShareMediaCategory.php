<?php


namespace Eniams\Notifier\LinkedIn\Option\ShareContent;

/**
 * @author Smaïne Milianni <contact@smaine.me>
 */
final class ShareMediaCategory
{
    public const ARTICLE = 'ARTICLE';
    public const IMAGE = 'IMAGE';
    public const NONE = 'NONE';
    public const RICH = 'RICH';
    public const VIDEO = 'VIDEO';
    public const LEARNING_COURSE = 'LEARNING_COURSE';
    public const JOB = 'JOB';
    public const QUESTION = 'QUESTION';
    public const ANSWER = 'ANSWER';
    public const CAROUSEL = 'CAROUSEL';
    public const TOPIC = 'TOPIC';
    public const NATIVE_DOCUMENT = 'NATIVE_DOCUMENT';
    public const URN_REFERENCE = 'URN_REFERENCE';
    public const LIVE_VIDEO = 'LIVE_VIDEO';

    public const ALL = [
        self::ARTICLE,
        self::IMAGE,
        self::NONE,
        self::RICH,
        self::VIDEO,
        self::LEARNING_COURSE,
        self::JOB,
        self::QUESTION,
        self::ANSWER,
        self::CAROUSEL,
        self::TOPIC,
        self::NATIVE_DOCUMENT,
        self::URN_REFERENCE,
        self::LIVE_VIDEO
    ];
}
