<?php

namespace Dxw\Iguana\Share;

describe(TwitterShareLink::class, function () {
    beforeEach(function () {
        $this->shareLink = new TwitterShareLink();
    });

    it('is a ShareLink', function () {
        expect($this->shareLink)->to->be->instanceof(ShareLink::class);
    });

    describe('->getLink()', function () {
        it('returns the link', function () {
            expect($this->shareLink->getLink('aaa bbb=ccc', 'ddd'))->to->equal('https://twitter.com/intent/tweet?url=aaa+bbb%3Dccc&text=ddd');
        });
    });

    describe('->getPlatform()', function () {
        it('returns the platform', function () {
            expect($this->shareLink->getPlatform())->to->equal('Twitter');
        });
    });
});
