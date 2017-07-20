# Note for WPUnit

WPUnit - Wordpress Unit tests are integration tests that check 
how components work inside WordPress. WPLoader is a module that loads, 
installs and configures a fresh WordPress installation before each test method runs. 
This has been enabled and configured inside wpunit.suite.yml file.


Commonly “WordPress unit tests” (hence the wpunit default name of the suite) 
are not related to classical unit tests but to integration tests. The difference 
is that unit tests are supposed to test a class methods in complete isolation, 
while integration tests check how components work inside WordPress. That’s why, 
to prepare WordPress for testing, you should enable WPLoader module into wpunit.suite.yml.

The WPLoader module: it takes care of loading, installing and configuring a fresh
WordPress installation before each test method runs.To handle the heavy lifting 
the module requires some information about the local WordPress installation: 
in the  codeception.yml file configure it to match your local setup


The module is wrapping and augmenting the WordPress Core automated testing suite 
and to generate a test case that uses Codeception and the methods provided by 
the Core testing suite you can use the generation command provided by the package:

codecept generate:wpunit integration "TestClass"

The generated test case extends the WPTestCase class and it exposes all the 
methods defined by  Codeception\Test\Unit test case and the Core suite \WP_UnitTestCase.
Additional test method generation possibilities are available to cover the 
primitive test cases offered in the Core testing suite using wpajax, wprest, wpcanonical, 
wpxmlrpc as arguments for the generate sub-command.

Any database interaction is wrapped in a transaction to guarantee isolation between tests.