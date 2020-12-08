# ContactSigner

[![TravisCI](https://travis-ci.org/phpexpertsinc/skeleton.svg?branch=master)](https://travis-ci.org/phpexpertsinc/skeleton)
[![Maintainability](https://api.codeclimate.com/v1/badges/503cba0c53eb262c947a/maintainability)](https://codeclimate.com/github/phpexpertsinc/SimpleDTO/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/503cba0c53eb262c947a/test_coverage)](https://codeclimate.com/github/phpexpertsinc/SimpleDTO/test_coverage)

ContractSigner: A simple Laravel web package to facilitate sending contract documents (NDAs, etc) to multiple people.

## Installation

Via Composer

```bash
composer require phpexperts/contract-signer
```

## Usage

This is a Laravel package and requires Laravel 6+ or later.

It will automagically install its own URLs / web routes.

For the admin interface:

* https://www.yourdomain.com/admin/contract-signer/

For the end-user contract signing route:

* https://www.yourdomain.com/contracts/sign/{emailaddress}/{contractId}

# Use cases

 ✔ Provides a web interface for contract signing.
 ✔ Rapidly delivers to-be-signed documents to multiple emails.
 ✔ Keeps track of whom has signed what documents.
 ✔ Regularly reminds recipients to sign the documents via email.

## Testing

```bash
phpunit --testdox
```

# Contributors

[Theodore R. Smith](https://www.phpexperts.pro/]) <theodore@phpexperts.pro>  
GPG Fingerprint: 4BF8 2613 1C34 87AC D28F  2AD8 EB24 A91D D612 5690  
CEO: PHP Experts, Inc.

## License

MIT license. Please see the [license file](LICENSE) for more information.

