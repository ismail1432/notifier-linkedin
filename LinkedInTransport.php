<?php

namespace Eniams\Notifier\LinkedIn;

use Symfony\Component\Notifier\Exception\LogicException;
use Symfony\Component\Notifier\Exception\TransportException;
use Symfony\Component\Notifier\Message\ChatMessage;
use Symfony\Component\Notifier\Message\MessageInterface;
use Symfony\Component\Notifier\Transport\AbstractTransport;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * @author Smaïne Milianni <contact@smaine.me>
 */
final class LinkedInTransport extends AbstractTransport
{
    protected const HOST = 'api.linkedin.com';
    protected const PROTOCOL_VERSION = '2.0.0';
    protected const ENDPOINT = 'https://api.linkedin.com/v2/ugcPosts';

    private $authToken;
    private $accountId;

    public function __construct(string $authToken, string $accountId, HttpClientInterface $client = null, EventDispatcherInterface $dispatcher = null)
    {
        $this->authToken = $authToken;
        $this->accountId = $accountId;

        parent::__construct($client, $dispatcher);
    }

    public function __toString(): string
    {
        return sprintf('linkedin:://%s', $this->getEndpoint());
    }

    public function supports(MessageInterface $message): bool
    {
        return $message instanceof ChatMessage;
    }

    /**
     * @see https://docs.microsoft.com/en-us/linkedin/marketing/integrations/community-management/shares/ugc-post-api
     */
    protected function doSend(MessageInterface $message): void
    {
        if (!$message instanceof ChatMessage) {
            throw new LogicException(sprintf('The "%s" transport only supports instances of "%s" (instance of "%s" given).', __CLASS__, ChatMessage::class, \get_class($message)));
        }

        if ((null !== $options = $message->getOptions()) && !$message->getOptions() instanceof LinkedInOptions) {
            throw new LogicException(sprintf('The "%s" transport only supports instances of "%s" for options.', __CLASS__, LinkedInOptions::class));
        }

        $lifecycleState = $options['lifecycleState'] ?? 'PUBLISHED';
        $visibility = $options['visibility'] ?? 'PUBLIC';

        $response = $this->client->request('POST', self::ENDPOINT, [
            'auth_bearer' => $this->authToken,
            'headers' => ['X-Restli-Protocol-Version' => self::PROTOCOL_VERSION],
            'json' => [
                "author" => "urn:li:person:$this->accountId",
                "lifecycleState" => $lifecycleState,
                "specificContent" =>
                    [
                        "com.linkedin.ugc.ShareContent" => [
                            "shareCommentary" => ["text" => $message->getSubject()],
                            "shareMediaCategory" => "NONE",
                        ]
                    ],
                "visibility" => ["com.linkedin.ugc.MemberNetworkVisibility" => $visibility],
            ]
        ]);

        if (201 !== $response->getStatusCode()) {
            throw new TransportException(sprintf('Unable to post the Linkedin message: %s.', $response->getContent(false)), $response);
        }

        $result = $response->toArray(false);

        if (!$result['id']) {
            throw new TransportException(sprintf('Unable to post the Linkedin Linkedin: %s.', $result['error']), $response);
        }
    }
}
