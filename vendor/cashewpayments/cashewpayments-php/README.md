<p align="center">
  <a href="https://github.com/cashewpaymentsio/cashewpayments-php/releases"><img src="https://img.shields.io/github/release/cashewpaymentsio/cashewpayments-php.svg" alt="Latest Version" /></a> <a href="https://travis-ci.org/cashewpaymentsio/cashewpayments-php"><img src="https://img.shields.io/travis/cashewpaymentsio/cashewpayments-php.svg" alt="Build Status" /></a> <a href="https://scrutinizer-ci.com/g/cashewpaymentsio/cashewpayments-php/"><img src="https://scrutinizer-ci.com/g/cashewpaymentsio/cashewpayments-php/badges/quality-score.png?b=master" alt="Scrutinizer" /></a> <a href="https://scrutinizer-ci.com/g/cashewpaymentsio/cashewpayments-php/"><img src="https://scrutinizer-ci.com/g/cashewpaymentsio/cashewpayments-php/badges/coverage.png?b=master" alt="Coverage" /></a>
</p>

# Cashewpayments SDK for PHP

PHP library for the [cashewpayments](https://cashewpayments.io) API.

## Installation

The recommended way to install [cashewpayments](https://cashewpayments.io) is through [Composer](https://getcomposer.org/):

```sh
composer require cashewpayments/cashewpayments-php
```

After installing, you need to require Composer's autoloader:

```php
require 'vendor/autoload.php';
```

## Quickstart

All configs are passed around as a single variable `config`:

```php
$cashewpayments = new \Cashewpayments\Cashewpayments([
    'merchant_id' => 'id_ ...',
    'secret_key' => 'sk_live_ ...',
]);
```

## RESTful

For information about Cashewpayments's RESTful API, see the [API documentation](https://docs.cashewpayments.io).

```php
use Cashewpayments\Exceptions\RESTfulException;

$params = [
    'status' => 'captured',
];

try {
    $response = $cashewpayments->get('/orders', $params);
} catch (RESTfulException $e) {
    echo $e->getErrorCode();
    exit;
}
print_r($response->json());
```

## GraphQL

For information about Cashewpayments's GraphQL API, see the [API documentation](https://docs.cashewpayments.io/graphql).

```php
use Cashewpayments\Exceptions\GraphQLException;

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
    $response = $cashewpayments->query($query, $variables);
} catch (GraphQLException $e) {
    print_r($e->getErrors());
    exit;
}
print_r($response->json());
```

## Sandbox

Set `sandbox` config variable to `true` for sandbox requests:

```php
$cashewpayments = new \Cashewpayments\Cashewpayments([
    'sandbox' => true,
    'merchant_id' => 'id_ ...',
    'secret_key' => 'sk_test_ ...',
]);
```

## Documentation

Fantastic documentation is available at [https://php.cashewpayments.io](https://php.cashewpayments.io).
