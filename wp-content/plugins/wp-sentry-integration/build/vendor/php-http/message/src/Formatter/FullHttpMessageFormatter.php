<?php

namespace WPSentry\ScopedVendor\Http\Message\Formatter;

use WPSentry\ScopedVendor\Http\Message\Formatter;
use WPSentry\ScopedVendor\Psr\Http\Message\MessageInterface;
use WPSentry\ScopedVendor\Psr\Http\Message\RequestInterface;
use WPSentry\ScopedVendor\Psr\Http\Message\ResponseInterface;
/**
 * A formatter that prints the complete HTTP message.
 *
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
class FullHttpMessageFormatter implements \WPSentry\ScopedVendor\Http\Message\Formatter
{
    /**
     * The maximum length of the body.
     *
     * @var int|null
     */
    private $maxBodyLength;
    /**
     * @param int|null $maxBodyLength
     */
    public function __construct($maxBodyLength = 1000)
    {
        $this->maxBodyLength = $maxBodyLength;
    }
    /**
     * {@inheritdoc}
     */
    public function formatRequest(\WPSentry\ScopedVendor\Psr\Http\Message\RequestInterface $request)
    {
        $message = \sprintf("%s %s HTTP/%s\n", $request->getMethod(), $request->getRequestTarget(), $request->getProtocolVersion());
        foreach ($request->getHeaders() as $name => $values) {
            $message .= $name . ': ' . \implode(', ', $values) . "\n";
        }
        return $this->addBody($request, $message);
    }
    /**
     * {@inheritdoc}
     */
    public function formatResponse(\WPSentry\ScopedVendor\Psr\Http\Message\ResponseInterface $response)
    {
        $message = \sprintf("HTTP/%s %s %s\n", $response->getProtocolVersion(), $response->getStatusCode(), $response->getReasonPhrase());
        foreach ($response->getHeaders() as $name => $values) {
            $message .= $name . ': ' . \implode(', ', $values) . "\n";
        }
        return $this->addBody($response, $message);
    }
    /**
     * Add the message body if the stream is seekable.
     *
     * @param MessageInterface $request
     * @param string           $message
     *
     * @return string
     */
    private function addBody(\WPSentry\ScopedVendor\Psr\Http\Message\MessageInterface $request, $message)
    {
        $stream = $request->getBody();
        if (!$stream->isSeekable() || 0 === $this->maxBodyLength) {
            // Do not read the stream
            return $message . "\n";
        }
        if (null === $this->maxBodyLength) {
            $message .= "\n" . $stream->__toString();
        } else {
            $message .= "\n" . \mb_substr($stream->__toString(), 0, $this->maxBodyLength);
        }
        $stream->rewind();
        return $message;
    }
}
