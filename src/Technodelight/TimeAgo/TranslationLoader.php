<?php

namespace Technodelight\TimeAgo;

use Technodelight\TimeAgo\Exception\InvalidLanguageCodeException;

class TranslationLoader
{
    const ERROR_INVALID_LANGUAGE_CODE = 'No such language: %s';
    const ERROR_CANNOT_FIND_CLASS  = 'Cannot load language resorce class: %s';

    const DEFAULT_SCRIPT_LOCALE = 'C';
    const DEFAULT_FALLBACK_LOCALE = 'en';

    private $defaultTranslations = [
        'da',
        'de',
        'en',
        'hu',
        'nl',
        'zh_CN'
    ];

    /**
     * An array of language codes => files
     *
     * @return array
     */
    public function translations()
    {
        return $this->defaultTranslations;
    }

    /**
     * @param  string $languageCode
     *
     * @return Translation
     */
    public function load($languageCode)
    {
        $translations = $this->translations();
//        if (!isset($translations[$languageCode])) {
        if (!in_array($languageCode, $translations)) {
            throw new InvalidLanguageCodeException(
                sprintf(self::ERROR_INVALID_LANGUAGE_CODE, $languageCode)
            );
        }

        /** @var $translationResourceClass \Technodelight\TimeAgo\Resource\Translation\Translation */
        $translationResourceClass = sprintf(
            'Technodelight\TimeAgo\Resource\Translation\%s',
            $this->languageCodeToClassName($languageCode)
        );
        if (!class_exists($translationResourceClass)) {
            throw new InvalidLanguageCodeException(
                sprintf(self::ERROR_CANNOT_FIND_CLASS, $translationResourceClass)
            );
        }

        return Translation::fromArray(
            $translationResourceClass::translations()
        );
    }

    /**
     * @return Translation
     */
    public function loadDefault()
    {
        return $this->load($this->detectLanguage());
    }

    /**
     * Returns the best matching language code based on system locale
     * If it is not able to detect any preferred language, it will
     * default to english
     *
     * @return string
     */
    public function detectLanguage()
    {
        $possibleLocales = array_filter(
            [setlocale(LC_TIME, 0), setlocale(LC_CTYPE, 0), getenv('LANG')],
            function($localeCode) {
                return $localeCode !== self::DEFAULT_SCRIPT_LOCALE;
            }
        );

        if ($firstMatchingLocale = reset($possibleLocales)) {
            $translations = $this->translations();
            $localeParts = preg_split('~[._]{1}~', $firstMatchingLocale);
            foreach ($localeParts as $languageCode) {
                if (in_array($languageCode, $translations)) {
                    return $languageCode;
                }
            }
        }

        return self::DEFAULT_FALLBACK_LOCALE;
    }

    /**
     * @param string $languageCode
     * @return string
     */
    private function languageCodeToClassName($languageCode)
    {
        return strtr(
            ucwords(
                strtr(strtolower($languageCode), ['_' => ' '])
            ),
            [' ' => '']
        );
    }
}
