<?php

namespace Technodelight\TimeAgo\Translation;

class Formatter
{
    use SecondsDurationMap;

    /**
     * @var string
     */
    private $duration;

    /**
     *
     * @var string
     */
    private $strategy;

    public function __construct($duration, $strategy = null)
    {
        $this->duration = $duration;
        $this->strategy = $strategy ?: 'round';
    }

    /**
     * @param int $seconds
     *
     * @return int
     */
    public function format($seconds)
    {
        return (int) call_user_func(
            $this->strategy,
            ($seconds / $this->secondsDurationMap[$this->duration])
        );
    }
}
