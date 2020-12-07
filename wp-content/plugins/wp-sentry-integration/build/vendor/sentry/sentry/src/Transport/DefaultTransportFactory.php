<?php

declare (strict_types=1);
namespace Sentry\Transport;

use WPSentry\ScopedVendor\Http\Message\MessageFactory as MessageFactoryInterface;
use WPSentry\ScopedVendor\Psr\Log\LoggerInterface;
use Sentry\HttpClient\HttpClientFactoryInterface;
use Sentry\Options;
/**
 * This class is the default implementation of the {@see TransportFactoryInterface}
 * interface.
 */
final class DefaultTransportFactory implements \Sentry\Transport\TransportFactoryInterface
{
    /**
     * @var MessageFactoryInterface The PSR-7 message factory
     */
    private $messageFactory;
    /**
     * @var HttpClientFactoryInterface The factory to create the HTTP client
     */
    private $httpClientFactory;
    /**
     * @var LoggerInterface|null A PSR-3 logger
     */
    private $logger;
    /**
     * Constructor.
     *
     * @param MessageFactoryInterface    $messageFactory    The PSR-7 message factory
     * @param HttpClientFactoryInterface $httpClientFactory The HTTP client factory
     * @param LoggerInterface|null       $logger            A PSR-3 logger
     */
    public function __construct(\WPSentry\ScopedVendor\Http\Message\MessageFactory $messageFactory, \Sentry\HttpClient\HttpClientFactoryInterface $httpClientFactory, ?\WPSentry\ScopedVendor\Psr\Log\LoggerInterface $logger = null)
    {
        $this->messageFactory = $messageFactory;
        $this->httpClientFactory = $httpClientFactory;
        $this->logger = $logger;
    }
    /**
     * {@inheritdoc}
     */
    public function create(\Sentry\Options $options) : \Sentry\Transport\TransportInterface
    {
        if (null === $options->getDsn(\false)) {
            return new \Sentry\Transport\NullTransport();
        }
        return new \Sentry\Transport\HttpTransport($options, $this->httpClientFactory->create($options), $this->messageFactory, \true, \false, $this->logger);
    }
}
