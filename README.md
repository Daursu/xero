# Xero API wrapper for Laravel 4

[![Latest Stable Version](https://poser.pugx.org/daursu/xero/v/stable.svg)](https://packagist.org/packages/daursu/xero) [![Total Downloads](https://poser.pugx.org/daursu/xero/downloads.svg)](https://packagist.org/packages/daursu/xero) [![Latest Unstable Version](https://poser.pugx.org/daursu/xero/v/unstable.svg)](https://packagist.org/packages/daursu/xero) [![License](https://poser.pugx.org/daursu/xero/license.svg)](https://packagist.org/packages/daursu/xero)

This is a wrapper for the official Xero API php library, found at: https://github.com/XeroAPI/XeroOAuth-PHP

Note: I have not implemented the entire API, instead I have created the core logic which can then be extended (see the examples below).

I have tested the library only with a Private app, but it should work for the others.

---------

## Installation

Using composer simply add this to your composer.json file:

```
"require": {
  "daursu/xero": "dev-master"
}
```

Use composer to install this package.

```
$ composer update
```

### Registering the Package

Register the service provider within the ```providers``` array found in ```app/config/app.php```:

```php
'providers' => array(
	// ...

	'Daursu\Xero\XeroServiceProvider',
)
```

### Publish the configuration file
```
php artisan config:publish daursu/xero
```
This should create a new file in ```app/config/packages/daursu/xero/config.php```. Update this file with your own settings and API key.
There is also a folder called ```certs```, where I recommend you to put your certificates.

Here is a guide how to generate your public/private key http://developer.xero.com/documentation/advanced-docs/public-private-keypair/


## Usage

The syntax is very simillar to the Laravel Eloquent one.

```php

use \Daursu\Xero\Invoice;
use \Daursu\Xero\Contact;

// Retrieve all the invoices
$invoices = Invoice::get();

foreach ($invoices as $invoice) {
    print_r($invoice->toArray());
    print_r($invoice->getId());
    print_r($invoice->InvoiceID);
}

// Retrive a single invoice
$invoice = Invoice::find("0263f2bd-5825-476b-b6cf-6b76896a8cff");
var_dump($invoice);

// The get method also takes additional parameters
$contact = Contact::get(array('where' => 'Name.Contains("Dan")'));

```

#### Create or update a record

This is pretty straight forward as well.

```php
use \Daursu\Xero\Invoice;
use \Daursu\Xero\Contact;

// Initialize from an array
$invoice = new Invoice(array(
    'Type' => 'ACCREC',
    'Status' => 'DRAFT',
    'Date' => date('Y-m-d'),
    ...
));

// Now you will need to attach a contact to the invoice
// Note that this time I am not passing an array to the constructor,
// this is just another way you can initialize objects
$contact = new Contact();
$contact->Name = "John Smith";

// Now you can assign it like this
$invoice->Contact = $contact;

// or
$invoice->setRelationship($contact);

// Save the invoice
$invoice->save(); // returns true or false

// Other methods
$invoice->update();
$invoice->create();

print_r($invoice->toArray()); // should have all the properties populated once it comes back from Xero

```

#### Collections
Collections are used when you need to specify multiple relationships (ie. A contact might have multiple addresses.

```php
use \Daursu\Xero\Contact;
use \Daursu\Xero\Address;

$contact = new Contact;
$contact->name = "John";

// IMPORTANT: A collection can only contain a single type of model
// in this case it can only hold addresses.
$collection = Address::newCollection(array(
			array('AddressType' => 'NEW', 'AddressLine1' => 'Cambridge', 'AddressLine2' => 'England'),
			array('AddressType' => 'OTHER', 'AddressLine1' => 'London', 'AddressLine2' => 'England'),
		));

// Push an new item
$collection->push(array('AddressType' => 'STREET', 'AddressLine1' => 'Street', 'AddressLine2' => 'England'));

// Push an existing object
$address = new Address(array('AddressType' => 'OBJECT', 'AddressLine1' => 'Oxford', 'AddressLine2' => 'England'));
$collection->push($address);

// Now set the relationship
$contact->setRelationship($collection);

// Or like this
$contact->Addresses = $collection;

// Save the contact
$contact->save();
```

#### Output methods
```php

// You can output an object using different methods
$address->toArray();
$address->toJson();
$address->toXML();
```

#### Extend the library
I have not implemented all the models that Xero provides, however it is very easy to implement. Here is an example of adding a new model called ```CreditNote```.

```php
// File CreditNote.php
<?php namespace Daursu\Xero;

class CreditNote extends BaseModel {

	/**
	 * The name of the primary column.
	 *
	 * @var string
	 */
	protected $primary_column = 'CreditNoteID';

}
```

That's it. You can now use it:

```php
use \Daursu\Xero\CreditNote;
use \Daursu\Xero\Contact;

$creditNote = new CreditNote();
$creditNote->Type = 'ACCPAYCREDIT';
$creditNote->Contact = new Contact(array("Name"=> "John");
$creditNote->save();

// Create a collection of credit notes
$collection = CreditNote::newCollection();
$collection->push($creditNote);

```

-----
> Feel free to fork and send pull requests if you extend this library.

## Changelog

Version 0.1 - Initial release

## License & Credits

Credits go to the official Xero API library found at https://github.com/XeroAPI/XeroOAuth-PHP.

This code is licensed under the MIT license. Feel free to modify and distribute.

http://www.softwareassistance.net

http://www.computerassistance.uk.com