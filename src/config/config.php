<?php

return array(

	/**
	* Define which app type you are using:
	* Private - private app method
	* Public - standard public app method
	* Partner - partner app method
	*/
	'application_type'  => 'Private',

	/**
	* Set a user agent string that matches your application name as set in the Xero developer centre
	*/
	'useragent' => 'LaravelXero',

	/**
	* Set your callback url or set 'oob' if none required
	*/
	'callback' => 'oob',

	/**
	* Application specific settings
	* Not all are required for given application types
	* consumer_key: required for all applications
	* consumer_secret: for partner applications, set to: s (cannot be blank)
	* rsa_private_key: application certificate private key - not needed for public applications
	* rsa_public_key: application certificate public cert - not needed for public applications
	*/
	'consumer_key'    => 'MWSAN8S5AAFPMMNBV3DQIEWH4TM9FE',
	'shared_secret'   => 's',
	// API versions
	'core_version'    => '2.0',
	'payroll_version' => '1.0',

	// The following are required only for Private or Partner apps
	'rsa_private_key' => dirname(__FILE__) . '/certs/privatekey.pem',
	'rsa_public_key'  => dirname(__FILE__) . '/certs/publickey.cer',

	/**
	* Special options for Partner applications
	* Partner applications require a Client SSL certificate which is issued by Xero
	* the certificate is issued as a .p12 cert which you will then need to split into a cert and private key:
	* openssl pkcs12 -in entrust-client.p12 -clcerts -nokeys -out entrust-cert.pem
	* openssl pkcs12 -in entrust-client.p12 -nocerts -out entrust-private.pem <- you will be prompted to enter a password
	*/

	// 'curl_ssl_cert'     => '/certs/entrust-cert-RQ3.pem',
	// 'curl_ssl_password' => '1234',
	// 'curl_ssl_key'      => '/certs/entrust-private-RQ3.pem',

	/*
	|--------------------------------------------------------------------------
	| Model aliases
	|--------------------------------------------------------------------------
	|
	| If you've extended the library, then here you will need to define
	| aliases for each model class you've created so that the library
	| can autoload them correctly.
	|
	*/
	'aliases' => array(
		'Account'  => 'Daursu\Xero\Models\Account',
		'Address'  => 'Daursu\Xero\Models\Address',
		'Contact'  => 'Daursu\Xero\Models\Contact',
		'Invoice'  => 'Daursu\Xero\Models\Invoice',
		'LineItem' => 'Daursu\Xero\Models\LineItem',
		'Payment'  => 'Daursu\Xero\Models\Payment',
	),

);