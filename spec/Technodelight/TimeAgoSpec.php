<?php

namespace spec\Technodelight;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use \DateTime;
use Technodelight\TimeAgo\Translator;

class TimeAgoSpec extends ObjectBehavior
{
    function it_is_able_to_provide_a_string_representation_of_a_date(Translator $translator)
    {
        $this->beConstructedWith(new DateTime('-1 minute'), $translator);
        $translator->translate(Argument::type('int'))->shouldBeCalled()->willReturn('less than a minute ago');
        $this->inWords()->shouldReturn('less than a minute ago');
    }

    function it_calculates_a_difference_between_two_dates(Translator $translator)
    {
        $this->beConstructedWith(new DateTime('-1 minute'), $translator);
        $translator->translate(60)->shouldBeCalled();

        $this->inWords();
    }

    function it_could_be_constructed_with_language_code()
    {
        $this->beConstructedWithTranslation(new DateTime('-1 minute'), 'nl');
        $this->inWords()->shouldReturn('1 minuut geleden');
    }
}
