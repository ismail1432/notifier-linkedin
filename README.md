LinkedIn Notifier
==============

Provides LinkedIn integration for Symfony Notifier.

### Installation

`$ composer require eniams/linkedin-notifier`

### Enable the Bundle

Add `Eniams\Notifier\LinkedIn\LinkedInNotifierBundle::class => ['all' => true],` in `bundles.php`

### Enable the LinkedIn transport
  
Add the `linkedin` chatter in `config/packages/notifier.yaml`

````yaml
framework:
    notifier:
        chatter_transports:
            linkedin: '%env(LINKEDIN_DSN)%'
````

### Define the DSN with your credential.

[You can see how to get credentials from LinkedIn](doc/CREDENTIALS_WORKFLOW.md)
`LINKEDIN_DSN='linkedin://token:user-id@default'`

### Use it !

the example suppose that you have enable the autowiring 

```php
<?php

use Symfony\Component\Notifier\Notification\Notification;
use Symfony\Component\Notifier\NotifierInterface;

public function message(NotifierInterface $notifier)
{
    $notification = new Notification('Hello World', ['chat/linkedin']);
    $notifier->send($notification);
}
```
