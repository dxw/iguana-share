<?php

namespace Dxw\Iguana\Share;

class FacebookShareLink implements ShareLink
{
	public function getLink(string $postLink, string $postTitle): string
	{
		return 'https://www.facebook.com/sharer/sharer.php?u='.urlencode($postLink);
	}

	public function getPlatform(): string
	{
		return 'Facebook';
	}
}
