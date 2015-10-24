<?php

namespace Technodelight\TimeAgo\Translation;

use Technodelight\TimeAgo\Translation\Formatter;
use Technodelight\TimeAgo\Translation\Rule;
use Technodelight\TimeAgo\Translation\RuleSet;

class DefaultRuleSet extends RuleSet
{
    public function __construct()
    {
        // case $seconds <= $this->inSeconds('29sec'):
        //     return $this->translation->text('lessThanAMinute');
        $this->add(new Rule('lessThanAMinute', '29sec'), new Formatter('sec'));

        // case $seconds <= $this->inSeconds('1min 29sec'):
        //     return $this->translation->text('oneMinute');
        $this->add(new Rule('oneMinute', '1min 29sec'), new Formatter('min'));

        // case $seconds <= $this->inSeconds('44min 29sec'):
        //     return sprintf(
        //         $this->translation->text('lessThanOneHour'),
        //         $this->secondsIn('min', $seconds)
        //     );
        $this->add(new Rule('lessThanOneHour', '44min 29sec'), new Formatter('min'));

        // case $seconds <= $this->inSeconds('1hour 29min 59sec'):
        //     return $this->translation->text('aboutOneHour');
        $this->add(new Rule('aboutOneHour', '1hour 29min 59sec'), new Formatter('min'));

        // case $seconds <= $this->inSeconds('23hour 59min 29sec'):
        //     return sprintf(
        //         $this->translation->text('hours'),
        //         $this->secondsIn('hour', $seconds)
        //     );
        $this->add(new Rule('hours', '23hour 59min 29sec'), new Formatter('hour'));

        // case $seconds <= $this->inSeconds('47hour 59min 29sec'):
        //     return $this->translation->text('aboutOneDay');
        $this->add(new Rule('aboutOneDay', '47hour 59min 29sec'), new Formatter('hour'));

        // case $seconds <= $this->inSeconds('29day 23hour 59min 29sec'):
        //     return sprintf(
        //         $this->translation->text('days'),
        //         $this->secondsIn('day', $seconds)
        //     );
        $this->add(new Rule('days', '29day 23hour 59min 29sec'), new Formatter('day'));

        // case $seconds <= $this->inSeconds('59day 23hour 59min 29sec'):
        //     return $this->translation->text('aboutOneMonth');
        $this->add(new Rule('aboutOneMonth', '59day 23hour 59min 29sec'), new Formatter('day'));

        // case $seconds < $this->inSeconds('1year'):
        //     return sprintf(
        //         $this->translation->text('months'),
        //         $this->secondsIn('month', $seconds, 'ceil')
        //     );
        $this->add(new Rule('months', '1year - 1sec'), new Formatter('month', 'ceil'));

        // case $seconds < $this->inSeconds('2year'):
        //     return $this->translation->text('aboutOneYear');
        $this->add(new Rule('aboutOneYear', '2year - 1sec'), new Formatter('year'));

        // default: // no need to check arithmetics here
        //     return sprintf(
        //         $this->translation->text('years'),
        //         $this->secondsIn('year', $seconds, 'floor')
        //     );
        $this->add(new Rule('years', '2year'), new Formatter('year', 'floor'));

    }
}
