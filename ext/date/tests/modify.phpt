--TEST--
Test for relative time changes across DST boundaries
--FILE--
<?php
date_default_timezone_set('America/Chicago');

$format = 'Y-m-d H:i:s T/e - U';
$sydneyTimezone = new DateTimeZone('Australia/Sydney');

echo 'Add to jump forward', PHP_EOL;
$date = new DateTimeImmutable('2020-03-08 00:00:00');
echo $date->modify('+2 hours')->format($format), PHP_EOL;
echo $date->add(new DateInterval('PT2H'))->format($format), PHP_EOL;
$date = new DateTimeImmutable('2020-10-04 00:00:00', $sydneyTimezone);
echo $date->modify('+2 hours')->format($format), PHP_EOL;
echo $date->add(new DateInterval('PT2H'))->format($format), PHP_EOL;

echo PHP_EOL, 'Add past jump forward', PHP_EOL;
$date = new DateTimeImmutable('2020-03-08 00:00:00');
echo $date->modify('+3 hours')->format($format), PHP_EOL;
echo $date->add(new DateInterval('PT3H'))->format($format), PHP_EOL;
$date = new DateTimeImmutable('2020-10-04 00:00:00', $sydneyTimezone);
echo $date->modify('+3 hours')->format($format), PHP_EOL;
echo $date->add(new DateInterval('PT3H'))->format($format), PHP_EOL;

echo PHP_EOL, 'Subtract past jump forward', PHP_EOL;
$date = new DateTimeImmutable('2020-03-08 03:00:00');
echo $date->modify('-2 hours')->format($format), PHP_EOL;
echo $date->sub(new DateInterval('PT2H'))->format($format), PHP_EOL;

echo PHP_EOL, 'Subtract to jump forward will skip past', PHP_EOL;
$date = new DateTimeImmutable('2020-03-08 03:00:00');
echo $date->modify('-1 hours')->format($format), PHP_EOL;
echo $date->sub(new DateInterval('PT1H'))->format($format), PHP_EOL;

echo PHP_EOL, 'Add past fall back', PHP_EOL;
$date = new DateTimeImmutable('2020-11-01 00:00:00');
echo $date->modify('+4 hours')->format($format), PHP_EOL;
echo $date->add(new DateInterval('PT4H'))->format($format), PHP_EOL;

echo PHP_EOL, 'Add through fall back', PHP_EOL;
$date = new DateTimeImmutable('2020-11-01 00:00:00');
echo $date->modify('+3 hours')->format($format), PHP_EOL;
echo $date->add(new DateInterval('PT3H'))->format($format), PHP_EOL;

echo PHP_EOL, 'Add at fall back', PHP_EOL;
$date = new DateTimeImmutable('2020-11-01 00:00:00');
echo $date->modify('+2 hours')->format($format), PHP_EOL;
echo $date->add(new DateInterval('PT2H'))->format($format), PHP_EOL;

echo PHP_EOL, 'Add before fall back', PHP_EOL;
$date = new DateTimeImmutable('2020-11-01 00:00:00');
echo $date->modify('+1 hours')->format($format), PHP_EOL;
echo $date->add(new DateInterval('PT1H'))->format($format), PHP_EOL;

echo PHP_EOL, 'Subtract past fall back', PHP_EOL;
$date = new DateTimeImmutable('2020-11-01 03:00:00');
echo $date->modify('-4 hours')->format($format), PHP_EOL;
echo $date->sub(new DateInterval('PT4H'))->format($format), PHP_EOL;

echo PHP_EOL, 'Subtract to before fall back', PHP_EOL;
$date = new DateTimeImmutable('2020-11-01 03:00:00');
echo $date->modify('-3 hours')->format($format), PHP_EOL;
echo $date->sub(new DateInterval('PT3H'))->format($format), PHP_EOL;

echo PHP_EOL, 'Subtract through fall back', PHP_EOL;
$date = new DateTimeImmutable('2020-11-01 03:00:00');
echo $date->modify('-2 hours')->format($format), PHP_EOL;
echo $date->sub(new DateInterval('PT2H'))->format($format), PHP_EOL;

echo PHP_EOL, 'Subtract at fall back', PHP_EOL;
$date = new DateTimeImmutable('2020-11-01 03:00:00');
echo $date->modify('-1 hours')->format($format), PHP_EOL;
echo $date->sub(new DateInterval('PT1H'))->format($format), PHP_EOL;

echo PHP_EOL, 'Subtract second', PHP_EOL;
$date = new DateTimeImmutable('2020-03-08 03:00:00');
echo $date->modify('-1 second')->format($format), PHP_EOL;
echo $date->sub(new DateInterval('PT1S'))->format($format), PHP_EOL;

?>
--EXPECT--
Add to jump forward
2020-03-08 03:00:00 CDT/America/Chicago - 1583654400
2020-03-08 03:00:00 CDT/America/Chicago - 1583654400
2020-10-04 03:00:00 AEDT/Australia/Sydney - 1601740800
2020-10-04 03:00:00 AEDT/Australia/Sydney - 1601740800

Add past jump forward
2020-03-08 04:00:00 CDT/America/Chicago - 1583658000
2020-03-08 04:00:00 CDT/America/Chicago - 1583658000
2020-10-04 04:00:00 AEDT/Australia/Sydney - 1601744400
2020-10-04 04:00:00 AEDT/Australia/Sydney - 1601744400

Subtract past jump forward
2020-03-08 00:00:00 CST/America/Chicago - 1583647200
2020-03-08 00:00:00 CST/America/Chicago - 1583647200

Subtract to jump forward will skip past
2020-03-08 01:00:00 CST/America/Chicago - 1583650800
2020-03-08 01:00:00 CST/America/Chicago - 1583650800

Add past fall back
2020-11-01 03:00:00 CST/America/Chicago - 1604221200
2020-11-01 03:00:00 CST/America/Chicago - 1604221200

Add through fall back
2020-11-01 02:00:00 CST/America/Chicago - 1604217600
2020-11-01 02:00:00 CST/America/Chicago - 1604217600

Add at fall back
2020-11-01 01:00:00 CST/America/Chicago - 1604214000
2020-11-01 01:00:00 CST/America/Chicago - 1604214000

Add before fall back
2020-11-01 01:00:00 CDT/America/Chicago - 1604210400
2020-11-01 01:00:00 CDT/America/Chicago - 1604210400

Subtract past fall back
2020-11-01 00:00:00 CDT/America/Chicago - 1604206800
2020-11-01 00:00:00 CDT/America/Chicago - 1604206800

Subtract to before fall back
2020-11-01 01:00:00 CDT/America/Chicago - 1604210400
2020-11-01 01:00:00 CDT/America/Chicago - 1604210400

Subtract through fall back
2020-11-01 01:00:00 CST/America/Chicago - 1604214000
2020-11-01 01:00:00 CST/America/Chicago - 1604214000

Subtract at fall back
2020-11-01 02:00:00 CST/America/Chicago - 1604217600
2020-11-01 02:00:00 CST/America/Chicago - 1604217600

Subtract second
2020-03-08 01:59:59 CST/America/Chicago - 1583654399
2020-03-08 01:59:59 CST/America/Chicago - 1583654399
