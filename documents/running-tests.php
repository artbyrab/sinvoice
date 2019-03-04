# Running tests

To run the tests navigate to the package root folder:
```
$ cd Rabus/Sinvoice
```

Run PHP Unit on the tests folder:
```
$ vendor/bin/phpunit tests
```

To run a single test class, replace dummy with the test and class name:
```
$ vendor/bin/phpunit --filter DummyTest tests/DummyClassTest.php
```