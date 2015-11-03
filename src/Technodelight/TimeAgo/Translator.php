<?php

namespace Technodelight\TimeAgo;

use Technodelight\TimeAgo\Translation;
use Technodelight\TimeAgo\TranslationLoader;
use Technodelight\TimeAgo\Translation\DefaultRuleSet;
use Technodelight\TimeAgo\Translation\RuleSet;

class Translator
{
    /**
     * @var Translation
     */
    private $translation;
    /**
     * @var RuleSet
     */
    private $ruleSet;

    public function __construct(Translation $translation = null, RuleSet $ruleSet = null)
    {
        $loader = new TranslationLoader;
        $this->translation = $translation ?: $loader->loadDefault();
        $this->ruleSet = $ruleSet ?: new DefaultRuleSet;
    }

    public function translate($seconds)
    {
        $matchedRule = $this->ruleSet->getMatchingRule($seconds);
        $formatter = $this->ruleSet->formatterForRule($matchedRule);
        return sprintf(
            $this->translation->text($matchedRule->name()),
            $formatter->format($seconds)
        );
    }
}
