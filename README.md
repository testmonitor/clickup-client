# TestMonitor Clickup Client

[![Latest Stable Version](https://poser.pugx.org/testmonitor/clickup-client/v/stable)](https://packagist.org/packages/testmonitor/clickup-client)
[![CircleCI](https://img.shields.io/circleci/project/github/testmonitor/clickup-client.svg)](https://circleci.com/gh/testmonitor/clickup-client)
[![Travis Build](https://travis-ci.com/testmonitor/clickup-client.svg?branch=main)](https://travis-ci.com/testmonitor/clickup-client)
[![Code Coverage](https://scrutinizer-ci.com/g/testmonitor/clickup-client/badges/coverage.png?b=main)](https://scrutinizer-ci.com/g/testmonitor/clickup-client/?branch=main)
[![Code Quality](https://scrutinizer-ci.com/g/testmonitor/clickup-client/badges/quality-score.png?b=main)](https://scrutinizer-ci.com/g/testmonitor/clickup-client/?branch=main)
[![StyleCI](https://styleci.io/repos/223973950/shield)](https://styleci.io/repos/223973950)
[![License](https://poser.pugx.org/testmonitor/clickup-client/license)](https://packagist.org/packages/testmonitor/clickup-client)

This package provides a very basic, convenient, and unified wrapper for [Clickup](https://clickup.com/).

## Table of Contents

- [Installation](#installation)
- [Usage](#usage)
- [Examples](#examples)
- [Tests](#tests)
- [Changelog](#changelog)
- [Contributing](#contributing)
- [Credits](#credits)
- [License](#license)

## Installation

To install the client you need to require the package using composer:

	$ composer require testmonitor/clickup-client

Use composer's autoload:

```php
require __DIR__.'/../vendor/autoload.php';
```

You're all set up now!

## Usage

This client only supports **oAuth authentication**. You'll need an Clickup application to proceed. If you haven't done so,
please read up with the [Clickup authentication docs](https://clickup.com/api/developer-portal/authentication#oauth-flow) on how
to create an application.

When your Clickup application is up and running, start with the oAuth authorization:

```php
$oauth = [
    'clientId' => '12345',
    'clientSecret' => 'abcdef',
    'redirectUrl' => 'https://redirect.myapp.com/',
];

$clickup = new \TestMonitor\Clickup\Client($oauth);

header('Location: ' . $clickup->authorizationUrl());
exit();
```

This will redirect the user to a page asking confirmation for your app getting access to Clickup. Make sure your redirectUrl points
back to your app. This URL should point to the following code:

```php
$oauth = [
    'clientId' => '12345',
    'clientSecret' => 'abcdef',
    'redirectUrl' => 'https://redirect.myapp.com/',
];

$clickup = new \TestMonitor\Clickup\Client($oauth);

$token = $clickup->fetchToken($_REQUEST['code']);
```

When everything went ok, you should have an access token (available through Token object). It will be valid for **one hour**.
After that, you'll have to refresh the token to regain access:

```php
$oauth = ['clientId' => '12345', 'clientSecret' => 'abcdef', 'redirectUrl' => 'https://redirect.myapp.com/'];
$token = new \TestMonitor\Clickup\AccessToken('eyJ0...'); // the token you got last time

$clickup = new \TestMonitor\Clickup\Client($oauth, $token);
```

## Examples

Get a list of Clickup workspaces:

```php
$workspaces = $clickup->workspaces();
```

Or creating a task, for example (using list id 12345):

```php
$workItem = $clickup->createTask(new \TestMonitor\Clickup\Resources\Task([
    'name' => 'Name of the task',
    'description' => 'Some description',
]), '12345');
```

## Tests

The package contains integration tests. You can run them using PHPUnit.

    $ vendor/bin/phpunit

## Changelog

Refer to [CHANGELOG](CHANGELOG.md) for more information.

## Contributing

Refer to [CONTRIBUTING](CONTRIBUTING.md) for contributing details.

## Credits

* **Thijs Kok** - *Lead developer* - [ThijsKok](https://github.com/thijskok)
* **Stephan Grootveld** - *Developer* - [Stefanius](https://github.com/stefanius)
* **Frank Keulen** - *Developer* - [FrankIsGek](https://github.com/frankisgek)

## License

The MIT License (MIT). Refer to the [License](LICENSE.md) for more information.
