<?php

namespace spec\Technodelight\TimeAgo\Translation;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RuleSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('lessThanAMinute', '29sec');
        $this->name()->shouldReturn('lessThanAMinute');
        $this->timespan()->shouldReturn(29);
    }

    function it_matches_if_seconds_are_less_than_timespan()
    {
        $this->match(15)->shouldReturn(true);
    }
}
