<?php

namespace Dxw\Iguana\Share;

interface ShareLink
{
	public function getPlatform(): string;
	public function getLink(string $postLink, string $postTitle): string;
}
