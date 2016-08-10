<?php

namespace Mindy\Locale\Tests;

use Mindy\Locale\Locale;

class DateFormatterTest extends \PHPUnit_Framework_TestCase
{
    public function testWeekInMonth()
    {
        $t = new Locale;
        for ($year = 1970; $year <= date('Y'); $year++) {
            for ($month = 1; $month <= 12; $month++) {
                $day = date('t', mktime(0, 0, 0, $month, 1, $year));
                $weekNum = $t->dateFormatter->format("W", mktime(0, 0, 0, $month, $day, $year));
            }
        }
    }

    public function testStringIntegerDate()
    {
        $t = new Locale;
        date_default_timezone_set('UTC');
        $this->assertEquals('2012 09 03 07:54:09', $t->dateFormatter->format("yyyy MM dd hh:mm:ss", 1346702049));
        $this->assertEquals('2012 09 03 07:54:09', $t->dateFormatter->format("yyyy MM dd hh:mm:ss", '1346702049'));
        $this->assertEquals('1927 04 30 04:05:51', $t->dateFormatter->format("yyyy MM dd hh:mm:ss", -1346702049));
        $this->assertEquals('1927 04 30 04:05:51', $t->dateFormatter->format("yyyy MM dd hh:mm:ss", '-1346702049'));
    }

    public function testStrToTimeDate()
    {
        $t = new Locale;
        date_default_timezone_set('UTC');
        $this->assertEquals('2012 09 03 09:54:09', $t->dateFormatter->format("yyyy MM dd hh:mm:ss", '2012-09-03 09:54:09 UTC'));
        $this->assertEquals('1927 04 30 05:05:51', $t->dateFormatter->format("yyyy MM dd hh:mm:ss", '1927-04-30 05:05:51 UTC'));
    }

    public function providerFormatWeekInMonth()
    {
        return [
            ['2012.06.01', 1],
            ['2012.06.02', 1],
            ['2012.06.03', 1],
            ['2012.06.09', 2],
            ['2012.06.10', 2],
            ['2012.06.16', 3],
            ['2012.06.17', 3],
            ['2012.06.23', 4],
            ['2012.06.24', 4],
            ['2012.06.30', 5],

            ['2011.10.01', 1],
            ['2011.10.03', 2],
            ['2011.10.08', 2],
            ['2011.10.10', 3],
            ['2011.10.15', 3],
            ['2011.10.17', 4],
            ['2011.10.22', 4],
            ['2011.10.24', 5],
            ['2011.10.29', 5],
            ['2011.10.31', 6],

            ['2012.12.23', 4],
            ['2012.12.30', 5],
            ['2012.12.31', 6],
            ['2013.01.01', 1],
            ['2013.01.02', 1],
            ['2013.01.07', 2],

            ['2010.12.17', 3],
            ['2010.12.24', 4],
            ['2010.12.31', 5],
            ['2011.01.01', 1],
            ['2011.01.08', 2],
            ['2011.01.15', 3],
        ];
    }

    /**
     * @dataProvider providerFormatWeekInMonth
     */
    public function testFormatWeekInMonth($date, $expected)
    {
        $t = new Locale;
        list($year, $month, $day) = explode('.', $date);
        $this->assertEquals($expected, $t->dateFormatter->format('W', mktime(12, 0, 0, (int)$month, (int)$day, (int)$year)));
    }
}
