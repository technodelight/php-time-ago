<?php

namespace Technodelight;

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
     * @param DateTime        $dateTime
     * @param Translator|null $translator
     */
    public function __construct(\DateTime $dateTime, Translator $translator = null)
    {
        $this->dateTime = $dateTime;
        $this->translator = $translator ?: new Translator;
    }

    /**
     * Instantiate TimeAgo with the desired built-in translation
     *
     * @param  DateTime $dateTime
     * @param  string   $languageCode
     *
     * @return TimeAgo
     */
    public static function withTranslation(\DateTime $dateTime, $languageCode)
    {
        $translationLoader = new TranslationLoader;
        return new self($dateTime, new Translator($translationLoader->load($languageCode)));
    }

    /**
     * @param  DateTime|null $now accepts a reference date
     *
     * @return string
     */
    public function inWords(\DateTime $now = null)
    {
        $now = $now ?: new \DateTime;
        return $this->translator->translate(
            $now->getTimestamp() - $this->dateTime->getTimestamp()
        );
    }
}
