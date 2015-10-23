<?php

namespace Technodelight\TimeAgo;

use \OutOfRangeException;

class Translation
{
    /**
     * @var array
     */
    private $textMap = array(
        'aboutOneDay' => "1 day ago",
        'aboutOneHour' => "about 1 hour ago",
        'aboutOneMonth' => "about 1 month ago",
        'aboutOneYear' => "about 1 year ago",
        'days' => "%s days ago",
        'hours' => "%s hours ago",
        'lessThanAMinute' => "less than a minute ago",
        'lessThanOneHour' => "%s minutes ago",
        'months' => "%s months ago",
        'oneMinute' => "1 minute ago",
        'years' => "over %s years ago"
    );

    public static function createFromFile($filepath)
    {
        $obj = new static;
        $obj->textMap = require_once $filepath;
        return $obj;
    }

    public function text($from)
    {
        if (!isset($this->textMap[$from])) {
            throw new OutOfRangeException('No such translation: ' . $from);

        }
        return $this->textMap[$from];
    }
}
