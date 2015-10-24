<?php

namespace spec\Technodelight\TimeAgo\Translation;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FormatterSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('day');
    }

    function it_formats_seconds_to_days()
    {
        $this->format(172000)->shouldReturn(2);
    }

    function it_can_format_with_strategy()
    {
        $this->beConstructedWith('day', 'floor');
        $this->format(172000)->shouldReturn(1);
    }
}
