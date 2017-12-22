<?php

namespace Dxw\Iguana\Share;

use \phpmock\mockery\PHPMockery;

describe(ShareButtons::class, function () {
    beforeEach(function () {
        $this->helpers = \Mockery::mock(\Dxw\Iguana\Theme\Helpers::class);

        $this->twitterShareLink = \Mockery::mock(TwitterShareLink::class, function ($mock) {
            $mock->shouldReceive('getPlatform')->with()->andReturn('The Tweeters');
            $mock->shouldReceive('getLink')->with('postlink', 'posttitle"')->andReturn('atwitterlink');
        });
        $this->facebookShareLink = \Mockery::mock(FacebookShareLink::class, function ($mock) {
            $mock->shouldReceive('getPlatform')->with()->andReturn('Facey McFacebook');
            $mock->shouldReceive('getLink')->with('postlink', 'posttitle"')->andReturn('afacebooklink');
        });
        $this->linkedInShareLink = \Mockery::mock(LinkedInShareLink::class, function ($mock) {
            $mock->shouldReceive('getPlatform')->with()->andReturn('LinkedIn');
            $mock->shouldReceive('getLink')->with('postlink', 'posttitle"')->andReturn('alinkedinlink');
        });

        $this->shareLinks = [
            $this->twitterShareLink,
            $this->facebookShareLink,
            $this->linkedInShareLink,
        ];

        $this->shareButtons = new ShareButtons($this->helpers, $this->shareLinks);

        PHPMockery::mock(__NAMESPACE__, 'esc_attr')->andReturnUsing(function ($a) {
            return '_'.$a.'_';
        });

        PHPMockery::mock(__NAMESPACE__, 'get_permalink')->with()->andReturn('postlink');

        PHPMockery::mock(__NAMESPACE__, 'get_the_title')->with()->andReturn('posttitle&quot;');
    });

    afterEach(function () {
        \Mockery::close();
    });

    it('is registerable', function () {
        expect($this->shareButtons)->to->be->instanceof(\Dxw\Iguana\Registerable::class);
    });

    describe('->register()', function () {
        it('registers helper', function () {
            $this->helpers->shouldReceive('registerFunction')->with('shareButtons', [$this->shareButtons, 'shareButtons'])->once();
            $this->shareButtons->register();
        });
    });

    describe('->shareButtons()', function () {
        it('outputs share buttons', function () {
            ob_start();
            $this->shareButtons->shareButtons();
            $output = ob_get_clean();

            expect($output)->to->equal(
                '<ul>' .
                '<li><a target="_blank" href="_atwitterlink_" class="_the_tweeters_">_The Tweeters_</a></li>' .
                '<li><a target="_blank" href="_afacebooklink_" class="_facey_mcfacebook_">_Facey McFacebook_</a></li>' .
                '<li><a target="_blank" href="_alinkedinlink_" class="_linkedin_">_LinkedIn_</a></li>' .
                '</ul>'
            );
        });
    });
});
