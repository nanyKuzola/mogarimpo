<?php

declare (strict_types=1);
namespace Sentry\Transport;

use Sentry\Event;
use Sentry\Spool\SpoolInterface;
/**
 * This transport stores the events in a queue to send them later.
 *
 * @author Stefano Arlandini <sarlandini@alice.it>
 */
final class SpoolTransport implements \Sentry\Transport\TransportInterface
{
    /**
     * @var SpoolInterface The spool instance
     */
    private $spool;
    /**
     * Constructor.
     *
     * @param SpoolInterface $spool The spool instance
     */
    public function __construct(\Sentry\Spool\SpoolInterface $spool)
    {
        $this->spool = $spool;
    }
    /**
     * Gets the spool.
     */
    public function getSpool() : \Sentry\Spool\SpoolInterface
    {
        return $this->spool;
    }
    /**
     * {@inheritdoc}
     */
    public function send(\Sentry\Event $event) : ?string
    {
        if ($this->spool->queueEvent($event)) {
            return (string) $event->getId(\false);
        }
        return null;
    }
}
