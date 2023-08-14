<?php

namespace Dxw\Iguana\Share;

describe(FacebookShareLink::class, function () {
    beforeEach(function () {
        $this->shareLink = new FacebookShareLink();
    });

    it('is a ShareLink', function () {
        expect($this->shareLink)->toBeAnInstanceOf(ShareLink::class);
    });

    describe('->getLink()', function () {
        it('returns the link', function () {
            expect($this->shareLink->getLink('aaa bbb=ccc', 'ddd'))->toEqual('https://www.facebook.com/sharer/sharer.php?u=aaa+bbb%3Dccc');
        });
    });

    describe('->getPlatform()', function () {
        it('returns the platform', function () {
            expect($this->shareLink->getPlatform())->toEqual('Facebook');
        });
    });
});
