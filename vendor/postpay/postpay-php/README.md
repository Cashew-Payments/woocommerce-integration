<p align="center">
  <a href="https://github.com/postpayio/postpay-php/releases"><img src="https://img.shields.io/github/release/postpayio/postpay-php.svg" alt="Latest Version" /></a> <a href="https://travis-ci.org/postpayio/postpay-php"><img src="https://img.shields.io/travis/postpayio/postpay-php.svg" alt="Build Status" /></a> <a href="https://scrutinizer-ci.com/g/postpayio/postpay-php/"><img src="https://scrutinizer-ci.com/g/postpayio/postpay-php/badges/quality-score.png?b=master" alt="Scrutinizer" /></a> <a href="https://scrutinizer-ci.com/g/postpayio/postpay-php/"><img src="https://scrutinizer-ci.com/g/postpayio/postpay-php/badges/coverage.png?b=master" alt="Coverage" /></a>
</p>

# Postpay SDK for PHP

PHP library for the [postpay](https://postpay.io) API.

## Installation

The recommended way to install [postpay](https://postpay.io) is through [Composer](https://getcomposer.org/):

```sh
composer require postpay/postpay-php
```

After installing, you need to require Composer's autoloader:

```php
require 'vendor/autoload.php';
```

## Quickstart

All configs are passed around as a single variable `config`:

```php
$postpay = new \Postpay\Postpay([
    'merchant_id' => 'id_ ...',
    'secret_key' => 'sk_live_ ...',
]);
```

## RESTful

For information about Postpay's RESTful API, see the [API documentation](https://docs.postpay.io).

```php
use Postpay\Exceptions\RESTfulException;

$params = [
    'status' => 'captured',
];

try {
    $response = $postpay->get('/orders', $params);
} catch (RESTfulException $e) {
    echo $e->getErrorCode();
    exit;
}
print_r($response->json());
```

## GraphQL

For information about Postpay's GraphQL API, see the [API documentation](https://docs.postpay.io/graphql).

```php
use Postpay\Exceptions\GraphQLException;

$query = <<<'QUERY'
query OrderList($status: String!) {
  orders(status: $status) {
    edges {
      node {
        orderId
      }
    }
  }
}
QUERY;

$variables = [
    'status' => 'captured',
];

try {
    $response = $postpay->query($query, $variables);
} catch (GraphQLException $e) {
    print_r($e->getErrors());
    exit;
}
print_r($response->json());
```

## Sandbox

Set `sandbox` config variable to `true` for sandbox requests:

```php
$postpay = new \Postpay\Postpay([
    'sandbox' => true,
    'merchant_id' => 'id_ ...',
    'secret_key' => 'sk_test_ ...',
]);
```

## Documentation

Fantastic documentation is available at [https://php.postpay.io](https://php.postpay.io).
