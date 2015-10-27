<?php

namespace Technodelight\TimeAgo\Translation;

use Technodelight\TimeAgo\Translation\Formatter;
use Technodelight\TimeAgo\Translation\Rule;
use Technodelight\TimeAgo\Translation\RuleSet;

class DefaultRuleSet extends RuleSet
{
    public function __construct()
    {
        $this->add(new Rule('lessThanAMinute', '29sec'), new Formatter('sec'));

        $this->add(new Rule('oneMinute', '1min 29sec'), new Formatter('min'));

        $this->add(new Rule('lessThanOneHour', '44min 29sec'), new Formatter('min'));

        $this->add(new Rule('aboutOneHour', '1hour 29min 59sec'), new Formatter('min'));

        $this->add(new Rule('hours', '23hour 59min 29sec'), new Formatter('hour'));

        $this->add(new Rule('aboutOneDay', '47hour 59min 29sec'), new Formatter('hour'));

        $this->add(new Rule('days', '29day 23hour 59min 29sec'), new Formatter('day'));

        $this->add(new Rule('aboutOneMonth', '59day 23hour 59min 29sec'), new Formatter('day'));

        $this->add(new Rule('months', '1year - 1sec'), new Formatter('month', 'ceil'));

        $this->add(new Rule('aboutOneYear', '2year - 1sec'), new Formatter('year'));

        $this->add(new Rule('years', '2year'), new Formatter('year', 'floor'));

    }
}
