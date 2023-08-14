<?php

namespace Dxw\Iguana\Share;

class ShareButtons implements \Dxw\Iguana\Registerable
{
    private $helpers;
    private $shareLinks;

    public function __construct($helpers, array $shareLinks)
    {
        $this->helpers = $helpers;
        $this->shareLinks = $shareLinks;
    }

    public function register()
    {
        $this->helpers->registerFunction('shareButtons', [$this, 'shareButtons']);
    }

    public function shareButtons()
    {
        echo '<ul>';

        foreach ($this->shareLinks as $shareLink) {
            echo sprintf(
                '<li><a target="_blank" href="%s" class="%s">%s</a></li>',
                esc_attr($shareLink->getLink(get_permalink(), html_entity_decode(get_the_title()))),
                esc_attr(preg_replace('/\W/', '_', strtolower($shareLink->getPlatform()))),
                esc_attr($shareLink->getPlatform())
            );
        }

        echo '</ul>';
    }
}
