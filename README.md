# Iguana Share

This package provides a reusable way to output simple, accessible lists of social sharing buttons which can be styled according to your need.

Available buttons: Facebook, Google Plus, LinkedIn and Twitter.

## How to use

Install the package: `composer require dxw/iguana-share`. You will also need [Iguana Theme Helpers](https://github.com/dxw/iguana-theme) installed.

Register the Share Buttons class in your `app/di.php` Iguana file, passing in an instance of the Iguana Helper class, and the classes for the buttons you require. e.g.

```php
$registrar->addInstance(new \Dxw\Iguana\Theme\Helpers());
$registrar->addInstance(\Dxw\Iguana\Share\ShareButtons(
	$registrar->getInstance(\Dxw\Iguana\Theme\Helpers::class,
		[
			new Dxw\Iguana\Share\FacebookShareLink();
			new Dxw\Iguana\Share\LinkedInShareLink();
			new Dxw\Iguana\Share\TwitterShareLink();
		]
	)
))
```

Then call `h()->shareButtons()` in your template file to output the share buttons HTML.
