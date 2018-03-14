<?php

namespace Technodelight;

use DateTime;
use Technodelight\TimeAgo\TranslationLoader;
use Technodelight\TimeAgo\Translator;

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

    /**
     * @param DateTime $dateTime
     * @param Translator|null $translator
     */
    public function __construct(DateTime $dateTime, Translator $translator = null)
    {
        $this->dateTime = $dateTime;
        $this->translator = $translator ?: new Translator;
    }

    /**
     * Instantiate TimeAgo with the desired built-in translation
     *
     * @param  DateTime $dateTime
     * @param  string $languageCode
     *
     * @return TimeAgo
     */
    public static function withTranslation(DateTime $dateTime, $languageCode)
    {
        $translationLoader = new TranslationLoader;

        return new self($dateTime, new Translator($translationLoader->load($languageCode)));
    }

    /**
     * Instantiate TimeAgo with auto-detect locale using DateTime only
     *
     * @param  DateTime $dateTime
     * @return TimeAgo
     */
    public static function fromDateTime(DateTime $dateTime)
    {
        return new self($dateTime);
    }

    /**
     * @param  DateTime|null $now accepts a reference date
     *
     * @return string
     */
    public function inWords(DateTime $now = null)
    {
        $now = $now ?: new DateTime;

        return $this->translator->translate(
            $now->getTimestamp() - $this->dateTime->getTimestamp()
        );
    }

    /**
     * Returns time ago using current datetime
     *
     * @return string
     */
    public function __toString()
    {
        return $this->inWords();
    }
}
