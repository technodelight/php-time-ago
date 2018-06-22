<?php

namespace Technodelight\TimeAgo\Translation;

interface SecondsDurationMap
{
    /**
     * Converts a definition like "1day" into seconds
     *
     * @param string $human
     * @return int
     */
    public function inSeconds($human);

    /**
     * Returns an amount for a duration type
     *
     * @param  string $duration
     * @return int
     */
    public function amountForDuration($duration);
}
