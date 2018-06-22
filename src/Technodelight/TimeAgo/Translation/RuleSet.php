<?php

namespace Technodelight\TimeAgo\Translation;

use \LogicException;

class RuleSet
{
    /**
     * @var Rule[]
     */
    private $rules = array();

    /**
     * Add new rule to the set with formatter
     *
     * @param Rule $rule the rule which determines where to "cut"
     * @param Formatter $formatter the formatter which is responsible to render the "amount" of time
     * @return void
     */
    public function add(Rule $rule, Formatter $formatter)
    {
        $this->rules[] = array($rule, $formatter);
    }

    /**
     * Finds a matching rule for an amount of time
     *
     * @param int $seconds
     * @return Rule|null
     */
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

    /**
     * Finds a (configured) formatter for a given rule
     *
     * @param Rule $ruleToFind
     * @return Formatter
     * @throws LogicException when no formatter found
     */
    public function formatterForRule(Rule $ruleToFind)
    {
        foreach ($this->rules as $ruleFormatterPair) {
            list($rule, $formatter) = $ruleFormatterPair;
            if ($rule == $ruleToFind) {
                return $formatter;
            }
        }

        throw new LogicException(sprintf('A formatter for rule %s was not found', $ruleToFind->name()));
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
