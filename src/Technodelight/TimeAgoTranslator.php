<?php

namespace Technodelight;

class TimeAgoTranslator
{
    const SECONDS_PER_MINUTE = 60;
    const SECONDS_PER_HOUR = 3600;
    const SECONDS_PER_DAY = 86400;
    const SECONDS_PER_MONTH = 2592000;
    const SECONDS_PER_YEAR = 31104000;

    public function translate($seconds)
    {
        switch (true) {
            case $seconds <= 29:
                return 'less than a minute ago';

            case $seconds > 29 && $seconds <= 89:
                return '1 minute ago';

            case $seconds > 89 && $seconds <= ($this->minutesInSeconds(44) + 29):
                return sprintf('%d minutes ago', $this->secondsInMinutes($seconds));

            case $seconds > ($this->minutesInSeconds(44) + 29)
                && $seconds <= ($this->hoursInSeconds(1) + $this->minutesInSeconds(29) + 59):
                return 'about 1 hour ago';

            case $seconds > ($this->hoursInSeconds(1) + $this->minutesInSeconds(29) + 59)
                && $seconds <= ($this->hoursInSeconds(23) + $this->minutesInSeconds(59) + 29):
                return sprintf('%d hours ago', $this->secondsInHours($seconds));

            case $seconds > ($this->hoursInSeconds(23) + $this->minutesInSeconds(59) + 29)
                && $seconds <= ($this->hoursInSeconds(47) + $this->minutesInSeconds(59) + 29):
                return '1 day ago';

            case $seconds > ($this->hoursInSeconds(47) + $this->minutesInSeconds(59) + 29)
                && $seconds <= ($this->daysInSeconds(29) + $this->hoursInSeconds(23) + $this->minutesInSeconds(59) + 29):
                return sprintf('%d days ago', $this->secondsInDays($seconds));

            case $seconds > ($this->daysInSeconds(29) + $this->hoursInSeconds(23) + $this->minutesInSeconds(59) + 29)
                && $seconds <= ($this->daysInSeconds(59) + $this->hoursInSeconds(23) + $this->minutesInSeconds(59) + 29):
                return 'about 1 month ago';

            case $seconds > ($this->daysInSeconds(59) + $this->hoursInSeconds(23) + $this->minutesInSeconds(59) + 29)
                && $seconds < self::SECONDS_PER_YEAR:
                return sprintf('%d months ago', $this->secondsInMonths($seconds));

            case $seconds >= self::SECONDS_PER_YEAR
                && $seconds < self::SECONDS_PER_YEAR * 2:
                return 'about 1 year ago';

            case $seconds >= self::SECONDS_PER_YEAR * 2:
                return sprintf('over %d years ago', $this->secondsInYears($seconds));
        }
    }

    private function minutesInSeconds($minutes)
    {
        return $minutes * self::SECONDS_PER_MINUTE;
    }
    private function secondsInMinutes($seconds)
    {
        return round($seconds / self::SECONDS_PER_MINUTE);
    }

    private function hoursInSeconds($hours)
    {
        return $hours * self::SECONDS_PER_HOUR;
    }
    private function secondsInHours($seconds)
    {
        return round($seconds / self::SECONDS_PER_HOUR);
    }

    private function daysInSeconds($days)
    {
        return $days * self::SECONDS_PER_DAY;
    }
    private function secondsInDays($seconds)
    {
        return round($seconds / self::SECONDS_PER_DAY);
    }

    private function secondsInMonths($seconds)
    {
        return ceil($seconds / self::SECONDS_PER_MONTH);
    }

    private function secondsInYears($seconds)
    {
        return floor($seconds / self::SECONDS_PER_YEAR);
    }
}
