<?php

declare(strict_types=1);

namespace Dsdeboer\GoogleTagManager;

use Bolt\Widget\Injector\RequestZone;

trait WidgetTrait
{
    /**
     * Gets an extension config value.
     *
     * @return mixed
     */
    private function getConfig(string $key)
    {
        return $this->extension->getConfig()->get($key);
    }

    /**
     * Determines whether the widget is.
     *
     * @return bool
     */
    private function isEnabled(): bool
    {
        $zones = $this->getConfig('zones');

        // if zones are not set, then assume it shouldn't be shown anywhere.
        if (!\is_array($zones) || 0 === \count($zones)) {
            return false;
        }

        $request = $this->extension->getRequest();

        foreach ($zones as $zone => $isEnabled) {
            if (!$isEnabled) {
                continue;
            }

            // Config only accepts backend and frontend, not async.
            if (!\in_array($zone, [RequestZone::FRONTEND, RequestZone::BACKEND], true)) {
                continue;
            }

            if (!RequestZone::is($request, $zone)) {
                continue;
            }

            // We're in the right zone and it's enabled in config.
            return true;
        }

        return false;
    }

    private function build(): ?string
    {
        $googleTagManagerId = $this->getConfig('google_tag_manager');
        $autoProvideBootstrap = $this->getConfig('auto_provide_bootstrap');
        $privacyPolicyUri = $this->getConfig('privacy_policy_uri') ?? '/privacy-policy';

        if (empty($googleTagManagerId)) {
            return null;
        }

        if ($this->isEnabled()) {
            return parent::run([
                'google_tag_manager' => $googleTagManagerId,
                'privacy_policy_uri' => $privacyPolicyUri,
                'auto_provide_bootstrap' => $autoProvideBootstrap,
            ]);
        }

        return null;
    }
}
