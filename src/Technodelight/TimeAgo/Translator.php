<?php

namespace Technodelight\TimeAgo;

class Translator
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

    public function translate($seconds)
    {
        switch (true) {
            case $seconds <= $this->inSeconds('29sec'):
                return 'less than a minute ago';

            case $seconds > $this->inSeconds('29sec')
                && $seconds <= $this->inSeconds('1min 29sec'):
                return '1 minute ago';

            case $seconds > $this->inSeconds('1min 29sec')
                && $seconds <= $this->inSeconds('44min 29sec'):
                return sprintf('%d minutes ago', $this->secondsIn('min', $seconds));

            case $seconds > $this->inSeconds('44min 29sec')
                && $seconds <= $this->inSeconds('1hour 29min 59sec'):
                return 'about 1 hour ago';

            case $seconds > $this->inSeconds('1hour 29min 59sec')
                && $seconds <= $this->inSeconds('23hour 59min 29sec'):
                return sprintf('%d hours ago', $this->secondsIn('hour', $seconds));

            case $seconds > $this->inSeconds('23hour 59min 29sec')
                && $seconds <= $this->inSeconds('47hour 59min 29sec'):
                return '1 day ago';

            case $seconds > $this->inSeconds('47hour 59min 29sec')
                && $seconds <= $this->inSeconds('29day 23hour 59min 29sec'):
                return sprintf('%d days ago', $this->secondsIn('day', $seconds));

            case $seconds > $this->inSeconds('29day 23hour 59min 29sec')
                && $seconds <= $this->inSeconds('59day 23hour 59min 29sec'):
                return 'about 1 month ago';

            case $seconds > $this->inSeconds('59day 23hour 59min 29sec')
                && $seconds < $this->inSeconds('1year'):
                return sprintf('%d months ago', $this->secondsIn('month', $seconds, 'ceil'));

            case $seconds >= $this->inSeconds('1year')
                && $seconds < $this->inSeconds('2year'):
                return 'about 1 year ago';

            case $seconds >= $this->inSeconds('2year'):
                return sprintf('over %d years ago', $this->secondsIn('year', $seconds, 'floor'));
        }
    }

    private function secondsIn($duration, $seconds, Callable $adjustment = null)
    {
        $exactValue = $seconds / $this->secondsDurationMap[$duration];
        return $adjustment ? $adjustment($exactValue) : round($exactValue);
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
