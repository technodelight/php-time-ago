<?php

namespace spec\Technodelight\TimeAgo;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TranslationSpec extends ObjectBehavior
{
    /**
     * @var array
     */
    private $textMap = array(
        'aboutOneDay' => "vor einem Tag",
        'aboutOneHour' => "vor etwa einer Stunde",
        'aboutOneMonth' => "vor etwa einem Monat",
        'aboutOneYear' => "vor etwa einem Jahr",
        'days' => "vor %s Tagen",
        'hours' => "vor %s Stunden",
        'lessThanAMinute' => "vor weniger als einer Minute",
        'lessThanOneHour' => "vor %s Minuten",
        'months' => "vor %s Monaten",
        'oneMinute' => "vor einer Minute",
        'years' => "vor über %s Jahren"
    );

    function let()
    {
        $this->beConstructedFromArray($this->textMap);
    }

    function it_has_a_given_translation()
    {
        $this->text('aboutOneDay')->shouldReturn('vor einem Tag');
    }

    function it_throws_exception_if_undefined_text_is_required()
    {
        $this->shouldThrow('OutOfRangeException')->duringText('nothing-here');
    }
}
