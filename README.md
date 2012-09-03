# CodeIgniter Handbook - Vol 2 - API Design
### [https://efendibooks.com/books/codeigniter-handbook/vol-2]

This repository is the complete code for Volume Two of The CodeIgniter Handbook by [Jamie Rumbelow](http://jamierumbelow.net).

## Installation / Setup

This small sample API--and associated code--is a regular CodeIgniter 2.1.2 application and requires PHP5.3 to run.

Use the following SQL schema dump to get a basic database set up and remember to configure **config/database.php**:

```sql
CREATE TABLE `api_clients` (
  `access_token` varchar(40),
  `shared_secret` varchar(40),
  `throttle_count` int(11),
  `throttled_at` datetime
) DEFAULT CHARSET=utf8;

INSERT INTO `api_clients` (`access_token`, `shared_secret`, `throttle_count`, `throttled_at`)
VALUES
	('4395dd07a3cfe84d9655bb2542907f3acd0024fe','3c697e1314808f56bd44bc5ccb4765607b433715',70,'2012-09-02 23:01:00');

CREATE TABLE `trackers` (
  `id` varchar(20),
  `name` varchar(200)
) DEFAULT CHARSET=utf8;

INSERT INTO `trackers` (`id`, `name`)
VALUES
	('ebook_downloads','eBook Downloads'),
	('website_visits','Website Visits');

CREATE TABLE `values` (
  `tracker_id` varchar(20),
  `value` varchar(200)
) DEFAULT CHARSET=utf8;

INSERT INTO `values` (`tracker_id`, `value`)
VALUES
	('website_visits','127.0.0.1'),
	('website_visits','::1'),
	('website_visits','0.0.0.0');
```

## Unit Tests

The state of the unit tests have divulged somewhat from what is described in the book, in order to reflect a slightly more comprehensive set of tests.

Some configuration now occurs in **phpunit.xml**, which sets up a few variables and loads the bootstrap file. The bootstrap file defines an `API\Tests\TestCase` class which contains the `request()` method built in the book.

Install PHPUnit 3.6.12 and run the tests:

	$ phpunit tests/trackers_test.php
	PHPUnit 3.6.12 by Sebastian Bergmann.

	Configuration read from /Users/jamierumbelow/Sites/efendibooks/codeigniter-handbook-vol-2-code/phpunit.xml

	.....

	Time: 1 second, Memory: 2.75Mb

	OK (5 tests, 15 assertions)

	$ phpunit tests/values_test.php
	PHPUnit 3.6.12 by Sebastian Bergmann.

	Configuration read from /Users/jamierumbelow/Sites/efendibooks/codeigniter-handbook-vol-2-code/phpunit.xml

	..

	Time: 1 second, Memory: 2.75Mb

	OK (2 tests, 7 assertions)

See you for Volume Three!