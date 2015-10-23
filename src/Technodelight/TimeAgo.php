<?php

namespace Technodelight;

use Technodelight\TimeAgoTranslator;
use \DateTime;

class TimeAgo
{
    /**
     * @var DateTime
     */
    private $dateTime;
    /**
     * @var TimeAgoTranslator
     */
    private $translator;

    public function __construct(DateTime $dateTime, TimeAgoTranslator $translator = null)
    {
        $this->dateTime = $dateTime;
        $this->translator = $translator ?: new TimeAgoTranslator;
    }

    public function inWords(DateTime $now = null)
    {
        $now = $now ?: new DateTime;
        return $this->translator->translate(
            $now->getTimestamp() - $this->dateTime->getTimestamp()
        );
    }
}
