<?php

namespace spec\Technodelight\TimeAgo;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TranslatorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Technodelight\TimeAgo\Translator');
    }

    // less than 29secs
    function it_returns_with_less_than_a_minute_if_value_is_less_than_29()
    {
        $this->translate(1)->shouldReturn('less than a minute ago');
        $this->translate(29)->shouldReturn('less than a minute ago');
    }

    // more than 29secs and less than 1min29secss
    function it_returns_with_one_minute_ago()
    {
        $this->translate(30)->shouldReturn('1 minute ago');
        $this->translate(89)->shouldReturn('1 minute ago');
    }

    // between 1min30secs and 44mins29secs
    function it_returns_x_minutes_ago()
    {
        $this->translate(90)->shouldReturn('2 minutes ago');
        $this->translate(44 * 60 + 29)->shouldReturn('44 minutes ago');
    }

    // between 44mins30secs and 1hour29mins59secs
    function it_returns_about_one_hour_ago()
    {
        $this->translate(44 * 60 + 30)->shouldReturn('about 1 hour ago');
        $this->translate(3600 + 29 * 60 + 59)->shouldReturn('about 1 hour ago');
    }

    // between 1hour29mins59secs and 23hours59mins29secs
    function it_returns_x_hours_ago()
    {
        $this->translate(3600 + 30 * 60)->shouldReturn('2 hours ago');
        $this->translate((23 * 3600) + (59 * 60) + 29)->shouldReturn('24 hours ago');
    }

    // between 23hours59mins30secs and 47hours59mins29secs
    function it_returns_a_day_ago()
    {
        $this->translate((23 * 3600) + (59 * 60) + 30)->shouldReturn('1 day ago');
        $this->translate((47 * 3600) + (59 * 60) + 29)->shouldReturn('1 day ago');
    }

    // between 47hours59mins30secs and 29days23hours59mins29secs
    function it_returns_x_days_ago()
    {
        $this->translate((47 * 3600) + (59 * 60) + 30)->shouldReturn('2 days ago');
        $this->translate((29 * 86400) + (23 * 3600) + (59 * 60) + 29)->shouldReturn('30 days ago');
    }

    // between 29days23hours59mins30secs and 59days23hours59mins29secs
    function it_returns_about_one_month_ago()
    {
        $this->translate((29 * 86400) + (23 * 3600) + (59 * 60) + 30)->shouldReturn('about 1 month ago');
        $this->translate((59 * 86400) + (23 * 3600) + (59 * 60) + 29)->shouldReturn('about 1 month ago');
    }

    // between 59days23hours59mins30secs and 1year (minus 1sec)
    function it_returns_x_months_ago()
    {
        $this->translate((59 * 86400) + (23 * 3600) + (59 * 60) + 30)->shouldReturn('2 months ago');
        $this->translate(31104000 - 1)->shouldReturn('12 months ago');
    }

    // between 1year and 2years (minus 1sec)
    function it_returns_about_one_year_ago()
    {
        $this->translate(31104000)->shouldReturn('about 1 year ago');
        $this->translate(31104000 * 2 -1)->shouldReturn('about 1 year ago');
    }

    // 2years or more
    function it_returns_x_years_ago()
    {
        $this->translate(31104000 * 2)->shouldReturn('over 2 years ago');
        $this->translate(31104000 * 3)->shouldReturn('over 3 years ago');
        $this->translate(31104000 * 3 + 12 * 86400)->shouldReturn('over 3 years ago');
    }
}
