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

## Customer Stories:

**As a Corporate Executive,**
 * I want to have all of my employees, contractors and apprentices sign Non-Disclosure Agreements and other contracts.
 * I want a record Who, What and When each document was sent to, signed, and returned.
 * I want an easy-to-use Document Signer for the end-user.
 * I want emails to be sent daily reminding each person of outstanding contracts that need to be signed.

## Minimum Viable Product (MVP)

 1. Store a Non-Disclosure Agreement as Electronically Signable Form.
 2. Display Contract via a Link created per Recipient based upon their Email Address.
 3. Record when the NDA was sent to each recipient.
 4. Provide a simple Electronic Signature apparatus for each contract, similar to DocuSign.
 5. Display a Report showing Who, What and When each document was sent to, signed, and returned.

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

