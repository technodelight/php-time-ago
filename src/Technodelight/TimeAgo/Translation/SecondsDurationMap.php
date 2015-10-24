<?php

namespace Technodelight\TimeAgo\Translation;

trait SecondsDurationMap
{
    /**
     * Durations mapped to values in seconds
     *
     * @var array
     */
    private $secondsDurationMap = array(
        'sec' => 1,
        'min' => 60,
        'hour' => 3600,
        'day' => 86400,
        'month' => 2592000,
        'year' => 31104000,
    );

    private function inSeconds($human)
    {
        $parts = explode(' ', preg_replace('~-\s+~', '-', $human));
        $seconds = 0;
        foreach ($parts as $def) {
            $operand = '+';
            if (strpos($def, '-') !== false) {
                $def = substr($def, strpos($def, '-') + 1);
                $operand = '-';
            }
            sscanf($def, '%d%s', $amount, $duration);

            $seconds += ($this->durationToSeconds($duration, $amount) * ($operand == '+' ? 1 : -1));
        }

        return $seconds;
    }

    private function durationToSeconds($duration, $amount)
    {
        return $amount * $this->secondsDurationMap[$duration];
    }
}
