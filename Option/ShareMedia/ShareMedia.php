<?php


namespace Eniams\Notifier\LinkedIn\Option\ShareMedia;

use Eniams\Notifier\LinkedIn\Exception\UndefinedLandingPageTitleOption;
use Eniams\Notifier\LinkedIn\Option\AbstractLinkedInOption;

/**
 * @author Smaïne Milianni <contact@smaine.me>
 *
 * @see https://docs.microsoft.com/en-us/linkedin/marketing/integrations/community-management/shares/ugc-post-api#sharemedia
 */
class ShareMedia extends AbstractLinkedInOption
{
    public function __construct(
        string $text,
        array $attributes = [],
        string $inferredLocale = null,
        bool $landingPage = false,
        string $landingPageTitle = null,
        string $landingPageUrl = null
    ) {
        $this->options['description'] = [
            'text' => $text,
            'attributes' => $attributes,
        ];

        if ($inferredLocale) {
            $this->options['description']['inferredLocale'] = $inferredLocale;
        }

        if ($landingPage || $landingPageUrl) {
            $this->options['landingPage']['landingPageUrl'] = $landingPageUrl;
        }

        if (null !== $landingPageTitle) {
            if (!in_array($landingPageTitle, LandingPageTitle::ALL)) {
                throw new UndefinedLandingPageTitleOption(sprintf(
                    "%s is not valid option, available options are %s",
                    $landingPageTitle,
                    \implode(", ", LandingPageTitle::ALL)
                ));
            }

            $this->options['landingPage']['landingPageTitle'] = $landingPageTitle;
        }
    }
}
