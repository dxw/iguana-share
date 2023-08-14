<?php

namespace Dxw\Iguana\Share;

use \Kahlan\Plugin\Double;

describe(ShareButtons::class, function () {
    beforeEach(function () {
        $this->helpers = Double::instance([
            'extends' => \Dxw\Iguana\Theme\Helpers::class
        ]);

        $this->twitterShareLink = Double::instance([
            'extends' => TwitterShareLink::class,
            'magicMethods' => true
        ]);
        allow($this->twitterShareLink)->toReceive('getPlatform')->andReturn('The Tweeters');
        allow($this->twitterShareLink)->toReceive('getLink')->andReturn('atwitterlink');

        $this->facebookShareLink = Double::instance([
            'extends' => FacebookShareLink::class,
            'magicMethods' => true
        ]);
        allow($this->facebookShareLink)->toReceive('getPlatform')->andReturn('Facey McFacebook');
        allow($this->facebookShareLink)->toReceive('getLink')->andReturn('afacebooklink');

        $this->linkedInShareLink = Double::instance([
            'extends' => LinkedInShareLink::class,
            'magicMethods' => true
        ]);
        allow($this->linkedInShareLink)->toReceive('getPlatform')->andReturn('LinkedIn');
        allow($this->linkedInShareLink)->toReceive('getLink')->andReturn('alinkedinlink');

        $this->shareLinks = [
            $this->twitterShareLink,
            $this->facebookShareLink,
            $this->linkedInShareLink,
        ];

        allow('esc_attr')->toBeCalled()->andRun(function ($a) {
            return '_' . $a . '_';
        });
        allow('get_permalink')->toBeCalled()->andReturn('postlink');
        allow('get_the_title')->toBeCalled()->andReturn('postitle&quot;');

        $this->shareButtons = new ShareButtons($this->helpers, $this->shareLinks);
    });

    afterEach(function () {
    });

    it('is registerable', function () {
        expect($this->shareButtons)->toBeAnInstanceOf(\Dxw\Iguana\Registerable::class);
    });

    describe('->register()', function () {
        it('registers helper', function () {
            allow($this->helpers)->toReceive('registerFunction');
            expect($this->helpers)->toReceive('registerFunction')->once();
            $this->shareButtons = new ShareButtons($this->helpers, $this->shareLinks);

            $this->shareButtons->register();
        });
    });

    describe('->register()', function () {
        it('registers helper', function () {
            expect($this->helpers)->toReceive('registerFunction')->once()->with('shareButtons', [$this->shareButtons, 'shareButtons']);

            $this->shareButtons->register();
        });
    });

    describe('->shareButtons()', function () {
        it('outputs share buttons', function () {
            ob_start();
            $this->shareButtons->shareButtons();
            $output = ob_get_clean();

            expect($output)->toEqual(
                '<ul>' .
                '<li><a target="_blank" href="_atwitterlink_" class="_the_tweeters_">_The Tweeters_</a></li>' .
                '<li><a target="_blank" href="_afacebooklink_" class="_facey_mcfacebook_">_Facey McFacebook_</a></li>' .
                '<li><a target="_blank" href="_alinkedinlink_" class="_linkedin_">_LinkedIn_</a></li>' .
                '</ul>'
            );
        });
    });
});
