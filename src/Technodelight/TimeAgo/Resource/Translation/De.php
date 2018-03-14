<?php

namespace Technodelight\TimeAgo\Resource\Translation;

class De implements Translation
{
    /**
     * @return array
     */
    public static function translations()
    {
        return [
            'aboutOneDay' => "vor einem Tag",
            'aboutOneHour' => "vor etwa einer Stunde",
            'aboutOneMonth' => "vor etwa einem Monat",
            'aboutOneYear' => "vor etwa einem Jahr",
            'days' => "vor %s Tagen",
            'hours' => "vor %s Stunden",
            'lessThanAMinute' => "vor weniger als einer Minute",
            'lessThanOneHour' => "vor %s Minuten",
            'months' => "vor %s Monaten",
            'oneMinute' => "vor einer Minute",
            'years' => "vor über %s Jahren",
        ];
    }
}
