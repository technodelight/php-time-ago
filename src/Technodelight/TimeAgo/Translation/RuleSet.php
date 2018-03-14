<?php

namespace Technodelight\TimeAgo\Translation;

use \LogicException;

class RuleSet
{
    private $rules = array();

    public function add(Rule $rule, Formatter $formatter)
    {
        $this->rules[] = array($rule, $formatter);
    }

    public function getMatchingRule($seconds)
    {
        $this->sortRulesByTimespan();
        $lastRule = null;
        foreach ($this->rules as $ruleFormatterPair) {
            list($rule, ) = $ruleFormatterPair;
            $lastRule = $rule;
            if ($rule->match($seconds)) {
                return $rule;
            }
        }

        return $lastRule;
    }

    public function formatterForRule(Rule $ruleToFind)
    {
        foreach ($this->rules as $ruleFormatterPair) {
            list($rule, $formatter) = $ruleFormatterPair;
            if ($rule == $ruleToFind) {
                return $formatter;
            }
        }

        throw new LogicException('A formatter should have been available');
    }

    private function sortRulesByTimespan()
    {
        uasort(
            $this->rules,
            function($pairOne, $pairTwo) {
                /** @var Rule $ruleOne */
                $ruleOne = $pairOne[0];
                /** @var Rule $ruleTwo */
                $ruleTwo = $pairTwo[0];

                if ($ruleOne->timespan() == $ruleTwo->timespan()) {
                    return 0;
                }

                return $ruleOne->timespan() < $ruleTwo->timespan() ? -1 : 1;
            }
        );
    }
}
