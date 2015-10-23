<?php

namespace Technodelight\TimeAgo;

use Technodelight\TimeAgo\Translation;

class Translator
{
    /**
     * @var Translation
     */
    private $translation;

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

    public function __construct(Translation $translation)
    {
        $this->translation = $translation;
    }

    public function translate($seconds)
    {
        switch (true) {
            case $seconds <= $this->inSeconds('29sec'):
                return $this->translation->text('lessThanAMinute');

            case $seconds > $this->inSeconds('29sec')
                && $seconds <= $this->inSeconds('1min 29sec'):
                return $this->translation->text('oneMinute');

            case $seconds > $this->inSeconds('1min 29sec')
                && $seconds <= $this->inSeconds('44min 29sec'):
                return sprintf(
                    $this->translation->text('lessThanOneHour'),
                    $this->secondsIn('min', $seconds)
                );

            case $seconds > $this->inSeconds('44min 29sec')
                && $seconds <= $this->inSeconds('1hour 29min 59sec'):
                return $this->translation->text('aboutOneHour');

            case $seconds > $this->inSeconds('1hour 29min 59sec')
                && $seconds <= $this->inSeconds('23hour 59min 29sec'):
                return sprintf(
                    $this->translation->text('hours'),
                    $this->secondsIn('hour', $seconds)
                );

            case $seconds > $this->inSeconds('23hour 59min 29sec')
                && $seconds <= $this->inSeconds('47hour 59min 29sec'):
                return $this->translation->text('aboutOneDay');

            case $seconds > $this->inSeconds('47hour 59min 29sec')
                && $seconds <= $this->inSeconds('29day 23hour 59min 29sec'):
                return sprintf(
                    $this->translation->text('days'),
                    $this->secondsIn('day', $seconds)
                );

            case $seconds > $this->inSeconds('29day 23hour 59min 29sec')
                && $seconds <= $this->inSeconds('59day 23hour 59min 29sec'):
                return $this->translation->text('aboutOneMonth');

            case $seconds > $this->inSeconds('59day 23hour 59min 29sec')
                && $seconds < $this->inSeconds('1year'):
                return sprintf(
                    $this->translation->text('months'),
                    $this->secondsIn('month', $seconds, 'ceil')
                );

            case $seconds >= $this->inSeconds('1year')
                && $seconds < $this->inSeconds('2year'):
                return $this->translation->text('aboutOneYear');

            case $seconds >= $this->inSeconds('2year'):
                return sprintf(
                    $this->translation->text('years'),
                    $this->secondsIn('year', $seconds, 'floor')
                );
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
