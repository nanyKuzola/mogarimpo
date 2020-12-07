<?php

declare (strict_types=1);
namespace Sentry\Integration;

use WPSentry\ScopedVendor\Jean85\PrettyVersions;
use WPSentry\ScopedVendor\PackageVersions\Versions;
use Sentry\Event;
use Sentry\SentrySdk;
use Sentry\State\Scope;
/**
 * This integration logs with the event details all the versions of the packages
 * installed with Composer; the root project is included too.
 */
final class ModulesIntegration implements \Sentry\Integration\IntegrationInterface
{
    /**
     * @var array<string, string> The list of installed vendors
     */
    private static $loadedModules = [];
    /**
     * {@inheritdoc}
     */
    public function setupOnce() : void
    {
        \Sentry\State\Scope::addGlobalEventProcessor(static function (\Sentry\Event $event) : Event {
            $integration = \Sentry\SentrySdk::getCurrentHub()->getIntegration(self::class);
            // The integration could be bound to a client that is not the one
            // attached to the current hub. If this is the case, bail out
            if (null !== $integration) {
                $integration->processEvent($event);
            }
            return $event;
        });
    }
    /**
     * Applies the information gathered by this integration to the event.
     *
     * @param self  $self  The instance of this integration
     * @param Event $event The event that will be enriched with the modules
     *
     * @deprecated since version 2.4, to be removed in 3.0
     */
    public static function applyToEvent(self $self, \Sentry\Event $event) : void
    {
        @\trigger_error(\sprintf('The "%s" method is deprecated since version 2.4 and will be removed in 3.0.', __METHOD__), \E_USER_DEPRECATED);
        $self->processEvent($event);
    }
    /**
     * Gathers information about the versions of the installed dependencies of
     * the application and sets them on the event.
     *
     * @param Event $event The event
     */
    private function processEvent(\Sentry\Event $event) : void
    {
        if (empty(self::$loadedModules)) {
            foreach (\WPSentry\ScopedVendor\PackageVersions\Versions::VERSIONS as $package => $rawVersion) {
                self::$loadedModules[$package] = \WPSentry\ScopedVendor\Jean85\PrettyVersions::getVersion($package)->getPrettyVersion();
            }
        }
        $event->setModules(self::$loadedModules);
    }
}
