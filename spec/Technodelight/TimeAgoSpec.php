<?php

namespace spec\Technodelight;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use \DateTime;

use Technodelight\TimeAgoTranslator;

class TimeAgoSpec extends ObjectBehavior
{
    function it_is_able_to_provide_a_string_representation_of_a_date(TimeAgoTranslator $timeAgoTranslator)
    {
        $this->beConstructedWith(new DateTime('-1 minute'), $timeAgoTranslator);
        $timeAgoTranslator->translate(Argument::type('int'))->shouldBeCalled()->willReturn('less than a minute ago');
        $this->inWords()->shouldReturn('less than a minute ago');
    }

    function it_calculates_a_difference_between_two_dates(TimeAgoTranslator $timeAgoTranslator)
    {
        $this->beConstructedWith(new DateTime('-1 minute'), $timeAgoTranslator);
        $timeAgoTranslator->translate(60)->shouldBeCalled();

        $this->inWords();
    }
}
