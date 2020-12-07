<?php

declare (strict_types=1);
namespace Sentry\HttpClient\Plugin;

use WPSentry\ScopedVendor\Http\Client\Common\Plugin as PluginInterface;
use WPSentry\ScopedVendor\Http\Discovery\StreamFactoryDiscovery;
use WPSentry\ScopedVendor\Http\Message\StreamFactory as HttplugStreamFactoryInterface;
use WPSentry\ScopedVendor\Http\Promise\Promise as PromiseInterface;
use WPSentry\ScopedVendor\Psr\Http\Message\RequestInterface;
use WPSentry\ScopedVendor\Psr\Http\Message\StreamFactoryInterface;
/**
 * This plugin encodes the request body by compressing it with Gzip.
 *
 * @author Stefano Arlandini <sarlandini@alice.it>
 */
final class GzipEncoderPlugin implements \WPSentry\ScopedVendor\Http\Client\Common\Plugin
{
    /**
     * @var HttplugStreamFactoryInterface|StreamFactoryInterface The PSR-17 stream factory
     */
    private $streamFactory;
    /**
     * Constructor.
     *
     * @param HttplugStreamFactoryInterface|StreamFactoryInterface|null $streamFactory The stream factory
     *
     * @throws \RuntimeException If the zlib extension is not enabled
     */
    public function __construct($streamFactory = null)
    {
        if (!\extension_loaded('zlib')) {
            throw new \RuntimeException('The "zlib" extension must be enabled to use this plugin.');
        }
        if (null === $streamFactory) {
            @\trigger_error(\sprintf('A PSR-17 stream factory is needed as argument of the constructor of the "%s" class since version 2.1.3 and will be required in 3.0.', self::class), \E_USER_DEPRECATED);
        } elseif (!$streamFactory instanceof \WPSentry\ScopedVendor\Http\Message\StreamFactory && !$streamFactory instanceof \WPSentry\ScopedVendor\Psr\Http\Message\StreamFactoryInterface) {
            throw new \InvalidArgumentException(\sprintf('The $streamFactory argument must be an instance of either the "%s" or the "%s" interface.', \WPSentry\ScopedVendor\Http\Message\StreamFactory::class, \WPSentry\ScopedVendor\Psr\Http\Message\StreamFactoryInterface::class));
        }
        $this->streamFactory = $streamFactory ?? \WPSentry\ScopedVendor\Http\Discovery\StreamFactoryDiscovery::find();
    }
    /**
     * {@inheritdoc}
     */
    public function handleRequest(\WPSentry\ScopedVendor\Psr\Http\Message\RequestInterface $request, callable $next, callable $first) : \WPSentry\ScopedVendor\Http\Promise\Promise
    {
        $requestBody = $request->getBody();
        if ($requestBody->isSeekable()) {
            $requestBody->rewind();
        }
        // Instead of using a stream filter we have to compress the whole request
        // body in one go to work around a PHP bug. See https://github.com/getsentry/sentry-php/pull/877
        $encodedBody = \gzcompress($requestBody->getContents(), -1, \ZLIB_ENCODING_GZIP);
        if (\false === $encodedBody) {
            throw new \RuntimeException('Failed to GZIP-encode the request body.');
        }
        $request = $request->withHeader('Content-Encoding', 'gzip');
        $request = $request->withBody($this->streamFactory->createStream($encodedBody));
        return $next($request);
    }
}
