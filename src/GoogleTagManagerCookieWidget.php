<?php

declare(strict_types=1);

namespace Dsdeboer\GoogleTagManager;

use Bolt\Widget\BaseWidget;
use Bolt\Widget\Injector\AdditionalTarget;
use Bolt\Widget\Injector\RequestZone;
use Bolt\Widget\TwigAwareInterface;

/**
 * Adds Google Tag Manager script into top of the <body> tag.
 */
class GoogleTagManagerCookieWidget extends BaseWidget implements TwigAwareInterface
{
    use WidgetTrait;

    protected $name = 'Google Tag Manager Cookie Widget';
    protected $target = AdditionalTarget::END_OF_BODY;
    protected $priority = 200;
    protected $template = '@google-tag-manager-body-widget/bootstrap_cookie_notice.twig';
    protected $cacheDuration = 0;

    /**
     * Because the extension config controls which zone the widget is loaded
     * in, the default zone needs to be set to everywhere.
     *
     * @var string
     */
    protected $zone = RequestZone::EVERYWHERE;

    public function run(array $params = []): ?string
    {
        return $this->build();
    }
}
