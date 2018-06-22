<?php

namespace Technodelight\TimeAgo\Translation;

class Formatter
{
    /**
     * @var string
     */
    private $duration;

    /**
     * @var string
     */
    private $strategy;

    /**
     * @var SecondsDurationMap
     */
    private $map;

    /**
     * @param string $duration
     * @param callable $strategy a rounding function like 'round', 'floor' or 'ceil'
     * @param SecondsDurationMap|null $map
     */
    public function __construct($duration, $strategy = null, SecondsDurationMap $map = null)
    {
        $this->duration = $duration;
        $this->strategy = is_callable($strategy) ? $strategy : 'round';
        $this->map = $map ?: new DefaultSecondsDurationMap;
    }

    /**
     * Return amount of seconds rounded according to configured strategy
     *
     * @param int|float $seconds
     * @return int
     */
    public function format($seconds)
    {
        return (int) call_user_func(
            $this->strategy,
            ($seconds / $this->map->amountForDuration($this->duration))
        );
    }
}
