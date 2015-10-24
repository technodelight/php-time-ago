<?php

namespace Technodelight\TimeAgo\Translation;

class Rule
{
    use SecondsDurationMap;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $timespan;

    public function __construct($name, $timespan)
    {
        $this->name = $name;
        $this->timespan = $this->inSeconds($timespan);
    }

    public function name()
    {
        return $this->name;
    }

    public function timespan()
    {
        return $this->timespan;
    }

    public function match($seconds)
    {
        return $seconds < $this->timespan;
    }

    private function inSeconds($human)
    {
        $parts = explode(' ', $human);
        $seconds = 0;
        foreach ($parts as $def) {
            sscanf($def, '%d%s', $amount, $duration);
            $seconds += $this->durationToSeconds($duration, $amount);
        }

        return $seconds;
    }

    private function durationToSeconds($duration, $amount)
    {
        return $amount * $this->secondsDurationMap[$duration];
    }
}
