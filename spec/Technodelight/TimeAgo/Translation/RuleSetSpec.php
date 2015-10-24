<?php

namespace spec\Technodelight\TimeAgo\Translation;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Technodelight\TimeAgo\Translation\Formatter;
use Technodelight\TimeAgo\Translation\Rule;

class RuleSetSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Technodelight\TimeAgo\Translation\RuleSet');
    }

    function it_can_accept_a_rule_and_associated_formatter()
    {
        $this->add(new Rule('days', '23hour'), new Formatter('days', 'day'));
    }

    function it_retrieves_first_matching()
    {
        $rule1 = new Rule('hours', '1hour');
        $rule2 = new Rule('hours', '3hour');
        $formatter = new Formatter('hours', 'hour');

        $this->add($rule1, $formatter);
        $this->add($rule2, $formatter);

        $this->getMatchingRule(3000)->shouldReturn($rule1);
    }

    function it_returns_last_if_no_match()
    {
        $rule1 = new Rule('hours', '1hour');
        $rule2 = new Rule('hours', '3hour');
        $formatter = new Formatter('hours', 'hour');

        $this->add($rule1, $formatter);
        $this->add($rule2, $formatter);

        $this->getMatchingRule(12000)->shouldReturn($rule2);
    }

    function it_orders_added_rules_by_duration()
    {
        $rule1 = new Rule('hours', '1hour');
        $rule2 = new Rule('hours', '3hour');
        $formatter = new Formatter('hours', 'hour');

        $this->add($rule2, $formatter);
        $this->add($rule1, $formatter);

        $this->getMatchingRule(3000)->shouldReturn($rule1);
    }

    function it_returns_the_formatter_for_a_given_rule()
    {
        $rule1 = new Rule('hours', '1hour');
        $rule2 = new Rule('hours', '3hour');
        $formatter = new Formatter('hours', 'hour');

        $this->add($rule2, $formatter);
        $this->add($rule1, $formatter);

        $this->formatterForRule($rule2)->shouldReturn($formatter);
    }
}
