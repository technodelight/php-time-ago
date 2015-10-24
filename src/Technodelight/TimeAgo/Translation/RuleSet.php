<?php

namespace Technodelight\TimeAgo\Translation;

use Technodelight\TimeAgo\Translation\Formatter;
use Technodelight\TimeAgo\Translation\Rule;

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
        foreach ($this->rules as $ruleFormatterPair) {
            list($rule, $formatter) = $ruleFormatterPair;
            if ($rule->match($seconds)) {
                return $rule;
            }
        }

        return $rule;
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
                $ruleOne = $pairOne[0];
                $ruleTwo = $pairTwo[0];

                if ($ruleOne->timespan() == $ruleTwo->timespan()) {
                    return 0;
                }

                return $ruleOne->timespan() < $ruleTwo->timespan() ? -1 : 1;
            }
        );
    }
}
