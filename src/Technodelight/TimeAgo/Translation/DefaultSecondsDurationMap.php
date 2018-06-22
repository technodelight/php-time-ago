<?php

namespace Technodelight\TimeAgo\Translation;

class DefaultSecondsDurationMap implements SecondsDurationMap
{
    /**
     * Durations mapped to values in seconds
     *
     * @var array [['duration' => 123]]
     */
    private $secondsDurationMap = array(
        'sec' => 1,
        'min' => 60,
        'hour' => 3600,
        'day' => 86400,
        'month' => 2592000,
        'year' => 31104000,
    );

    /**
     * Converts a definition like "1day" into seconds
     *
     * @param string $human
     * @return int
     */
    public function inSeconds($human)
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

    /**
     * Returns an amount for a duration type
     *
     * @param  string $duration
     * @return int
     */
    public function amountForDuration($duration)
    {
        if (isset($this->secondsDurationMap[$duration])) {
            return $this->secondsDurationMap[$duration];
        }

        return 0;
    }

    /**
     * @param string $duration
     * @param int $amount
     * @return int
     */
    private function durationToSeconds($duration, $amount)
    {
        return $amount * $this->secondsDurationMap[$duration];
    }
}
