<?php

namespace Eniams\Notifier\LinkedIn;

use Symfony\Component\Notifier\Exception\UnsupportedSchemeException;
use Symfony\Component\Notifier\Transport\AbstractTransportFactory;
use Symfony\Component\Notifier\Transport\Dsn;
use Symfony\Component\Notifier\Transport\TransportInterface;

/**
 * @author Smaïne Milianni <contact@smaine.me>
 */
final class LinkedInTransportFactory extends AbstractTransportFactory
{
    public function create(Dsn $dsn): TransportInterface
    {
        $scheme = $dsn->getScheme();
        $authToken = $this->getUser($dsn);
        $accountId = $this->getPassword($dsn);
        $host = 'default' === $dsn->getHost() ? null : $dsn->getHost();
        $port = $dsn->getPort();

        if ('linkedin' === $scheme) {
            return (new LinkedInTransport($authToken, $accountId, $this->client, $this->dispatcher))->setHost($host)->setPort($port);
        }

        throw new UnsupportedSchemeException($dsn, 'linkedin', $this->getSupportedSchemes());
    }

    protected function getSupportedSchemes(): array
    {
        return ['linkedin'];
    }
}
