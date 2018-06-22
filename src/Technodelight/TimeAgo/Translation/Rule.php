<?php

namespace Technodelight\TimeAgo\Translation;

class Rule
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $timespan;

    /**
     * @param string $name the name of the rule, used as translation key
     * @param string $timespan timespan definition, like '1hour 29sec'
     * @param SecondsDurationMap|null $map
     * @see SecondsDurationMap
     */
    public function __construct($name, $timespan, SecondsDurationMap $map = null)
    {
        $map = $map ?: new DefaultSecondsDurationMap;
        $this->name = $name;
        $this->timespan = $map->inSeconds($timespan);
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function timespan()
    {
        return $this->timespan;
    }

    /**
     * @param int|float $seconds
     * @return bool
     */
    public function match($seconds)
    {
        return $seconds <= $this->timespan;
    }
}
