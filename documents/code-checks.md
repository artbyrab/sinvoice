# Code Checks

You can check the code using PHP Coding Standards Fixer.

* PHP Coding Standards Fixer
    * https://github.com/FriendsOfPhp/PHP-CS-Fixer

## To run PHP CS Fixer

PHP CS Fixer by default formats to PSR1 and PSR2 standards.

To run it navigate to the repo's main directory:
```
$ cd .../rabus/Sinvoice
```

Then run the following commands:
```
$ vendor/bin/php-cs-fixer fix src -v
$ vendor/bin/php-cs-fixer fix tests -v
```

You can run a dry run to see the errors:
```
$ vendor/bin/php-cs-fixer fix src --dry-run -v
```

You would now need to commit the changes before pushing.