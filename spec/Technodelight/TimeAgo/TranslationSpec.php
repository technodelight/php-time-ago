<?php

namespace spec\Technodelight\TimeAgo;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TranslationSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Technodelight\TimeAgo\Translation');
    }
}
