<?php

namespace Dxw\Iguana\Share;

class GooglePlusShareLink implements ShareLink
{
    public function getLink(string $postLink, string $postTitle) : string
    {
        return 'https://plus.google.com/share?url='.urlencode($postLink);
    }

    public function getPlatform() : string
    {
        return 'Google+';
    }
}
