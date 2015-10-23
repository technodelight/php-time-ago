<?php

namespace Technodelight\TimeAgo\Translation;

class Formatter
{
    use SecondsDurationMap;

    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $duration;

    public function __construct($name, $duration)
    {
        $this->name = $name;
        $this->duration = $duration;
    }

    public function name()
    {
        return $this->name;
    }

    /**
     * @param int $seconds
     * @param Callable $strategy
     *
     * @return int
     */
    public function format($seconds, Callable $strategy = null)
    {
        $strategy = $strategy ?: 'round';
        return (int) $strategy($seconds / $this->secondsDurationMap[$this->duration]);
    }
}
