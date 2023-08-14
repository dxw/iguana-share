<?php

namespace Dxw\Iguana\Share;

class LinkedInShareLink implements ShareLink
{
	public function getLink(string $postLink, string $postTitle): string
	{
		return 'https://www.linkedin.com/shareArticle?url='.urlencode($postLink);
	}

	public function getPlatform(): string
	{
		return 'LinkedIn';
	}
}
