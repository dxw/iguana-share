<?php

namespace Dxw\Iguana\Share;

class TwitterShareLink implements ShareLink
{
    public function getLink(string $postLink, string $postTitle) : string
    {
        return sprintf('https://twitter.com/intent/tweet?url=%s&text=%s', urlencode($postLink), urlencode($postTitle));
    }

    public function getPlatform() : string
    {
        return 'Twitter';
    }
}
