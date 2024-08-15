<?php

namespace Technodelight\TimeAgo;

use Technodelight\TimeAgo\Exception\UnexpectedTranslationIdException;

class Translation
{
    /**
     * @var array
     */
    private $textMap;

    private function __construct(array $textMap)
    {
        $this->textMap = $textMap;
    }

    /**
     * Accepts a map of definitions to translations
     *
     * @param  array  $textMap
     *
     * @return Translation
     */
    public static function fromArray(array $textMap)
    {
        return new self($textMap);
    }

    public function text($from)
    {
        if (!isset($this->textMap[$from])) {
            throw new UnexpectedTranslationIdException('No such translation: ' . $from);

        }
        return $this->textMap[$from];
    }
}
