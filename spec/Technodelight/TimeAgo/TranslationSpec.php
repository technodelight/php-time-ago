<?php

namespace spec\Technodelight\TimeAgo;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

// 'aboutOneDay' => "1 day ago",
// 'aboutOneHour' => "about 1 hour ago",
// 'aboutOneMonth' => "about 1 month ago",
// 'aboutOneYear' => "about 1 year ago",
// 'days' => "%s days ago",
// 'hours' => "%s hours ago",
// 'lessThanAMinute' => "less than a minute ago",
// 'lessThanOneHour' => "%s minutes ago",
// 'months' => "%s months ago",
// 'oneMinute' => "1 minute ago",
// 'years' => "over %s years ago"

class TranslationSpec extends ObjectBehavior
{
    function it_has_a_given_translation()
    {
        $this->text('aboutOneDay')->shouldReturn('1 day ago');
    }

    function it_throws_exception_if_undefined_text_is_required()
    {
        $this->shouldThrow('OutOfRangeException')->duringText('not-here');
    }
}
