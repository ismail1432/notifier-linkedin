<?php

namespace Eniams\Notifier\LinkedIn\Option\ShareContent;

use Eniams\Notifier\LinkedIn\Exception\UndefinedShareMediaCategoryOption;
use Eniams\Notifier\LinkedIn\Option\AbstractLinkedInOption;
use Eniams\Notifier\LinkedIn\Option\ShareMedia\ShareMedia;
use Eniams\Notifier\LinkedIn\Option\ShareContent\ShareMediaCategory;

/**
 * @author Smaïne Milianni <contact@smaine.me>
 *
 * @see https://docs.microsoft.com/en-us/linkedin/marketing/integrations/community-management/shares/ugc-post-api#sharecontent
 */
final class ShareContentOption extends AbstractLinkedInOption
{
    public function __construct(string $text, array $attributes = [], string $inferredLocale = null, ShareMedia $media = null, string $primaryLandingPageUrl = null, string $shareMediaCategory = ShareMediaCategory::NONE)
    {
        $this->options['shareCommentary'] = [
            'attributes' => $attributes,
            'text' => $text
        ];

        if (null !== $inferredLocale) {
            $this->options['shareCommentary']['inferredLocale'] = $inferredLocale;
        }

        if (null !== $media) {
            $this->options['media'] = $media->toArray();
        }

        if (null !== $primaryLandingPageUrl) {
            $this->options['primaryLandingPageUrl'] = $primaryLandingPageUrl;
        }

        if ($shareMediaCategory) {
            if (!in_array($shareMediaCategory, ShareMediaCategory::ALL)) {
                throw new UndefinedShareMediaCategoryOption(sprintf(
                    "%s is not valid option, available options are %s",
                    $shareMediaCategory,
                    \implode(", ", ShareMediaCategory::ALL)
                ));
            }

            $this->options['shareMediaCategory'] = $shareMediaCategory;
        }
    }
}
