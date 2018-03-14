<?php

namespace Technodelight\TimeAgo\Resource\Translation;

class Hu implements Translation
{
    /**
     * @return array
     */
    public static function translations()
    {
        return [
            'aboutOneDay' => "1 napja",
            'aboutOneHour' => "körülbelül 1 órája",
            'aboutOneMonth' => "körülbelül 1 hónapja",
            'aboutOneYear' => "körülbelül 1 éve",
            'days' => "%s napja",
            'hours' => "%s órája",
            'lessThanAMinute' => "kevesebb, mint egy perce",
            'lessThanOneHour' => "%s perce",
            'months' => "%s hónapja",
            'oneMinute' => "1 perce",
            'years' => "több, mint %s éve",
        ];
    }
}

