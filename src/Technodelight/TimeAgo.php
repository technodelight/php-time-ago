<?php

namespace Technodelight;

use Technodelight\TimeAgo\Translator;
use \DateTime;

class TimeAgo
{
    /**
     * @var DateTime
     */
    private $dateTime;
    /**
     * @var Translator
     */
    private $translator;

    public function __construct(DateTime $dateTime, Translator $translator = null)
    {
        $this->dateTime = $dateTime;
        $this->translator = $translator ?: new Translator;
    }

    public function inWords(DateTime $now = null)
    {
        $now = $now ?: new DateTime;
        return $this->translator->translate(
            $now->getTimestamp() - $this->dateTime->getTimestamp()
        );
    }
}
