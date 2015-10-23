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
}
