# honeycomb-invoices  
Invoices package for HoneyComb CMS
https://github.com/honey-comb/invoices

## Description

HoneyComb CMS invoices functions

## Attention

This is part invoices package for HoneyComb CMS package.

## Requirement

 - php: `^7.1`
 - laravel: `^5.6`
 - composer
 
 ## Installation

Begin by installing this package through Composer.


```js
	{
	    "require": {
	        "honey-comb/invoices": "0.1.*"
	    }
	}
```
or
```js
    composer require honey-comb/invoices
```

## Usage

If you use [honey-comb/payments](https://github.com/honey-comb/payments) package you can use our generated payment created event listener example to generate invoice.

- Run `php artisan vendor:publish --tag=hc-invoice`

- Register event in EventServiceProvider 
```php
protected $listen = [
    \HoneyComb\Payments\Events\HCPaymentCreated::class => [
        \App\Listeners\HCPaymentCreatedListener::class
    ],
];
```

The are two DTO's
`HCInvoiceDTO` and `HCInvoiceItemDTO`


Create invoice:

```php
$invoiceItemDto = (new HCInvoiceItemDTO())
        ->setLabel('Product')
        ->setQuantity(1)
        ->setVat(2)
        ->setAmount(10)
        ->setUnitPrice(10)
        ->setVatTotal(2)
        ->setAmountTotal(12);

$invoiceDto = (new HCInvoiceDTO())
    ->setAmount(10)
    ->setAmountTotal(12)
    ->setVat(2)
    ->setInvoiceDate('2016-04-13')
    ->setItems([
        $invoiceItemDto->toArray(),
    ]);

return $this->invoiceService->createAdvanceInvoice($invoiceDto->toArray());
```
