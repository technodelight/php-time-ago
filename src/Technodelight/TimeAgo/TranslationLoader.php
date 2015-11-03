<?php

namespace Technodelight\TimeAgo;

use Technodelight\TimeAgo\Exception\InvalidLanguageCodeException;
use Technodelight\TimeAgo\Translation;

class TranslationLoader
{
    const DEFAULT_TRANSLATIONS_DIRECTORY = '/../../translations';

    const ERROR_INVALID_LANGUAGE_CODE = 'No such language: %s';

    const DEFAULT_SCRIPT_LOCALE = 'C';
    const DEFAULT_FALLBACK_LOCALE = 'en';

    private $directory;

    /**
     * Sets or gets the translation directory to load translation files from
     *
     * @param  string|null $directory
     *
     * @return string
     */
    public function translationDirectory($directory = null)
    {
        if (!isset($this->directory)) {
            $this->directory = __DIR__ . self::DEFAULT_TRANSLATIONS_DIRECTORY;
        }
        if (!is_null($directory)) {
            $this->directory = rtrim($directory, DIRECTORY_SEPARATOR);
        }

        return $this->directory;
    }

    /**
     * An array of language codes => files
     *
     * @return array
     */
    public function translations()
    {
        $translationFiles = array();
        foreach (glob($this->translationDirectory() . DIRECTORY_SEPARATOR . '*.php') as $translationFile) {
            $translationFiles[pathinfo($translationFile, PATHINFO_FILENAME)] = basename($translationFile);
        }

        return $translationFiles;
    }

    /**
     * @param  string $languageCode
     *
     * @return Translation
     */
    public function load($languageCode)
    {
        $translations = $this->translations();
        if (!isset($translations[$languageCode])) {
            throw new InvalidLanguageCodeException(
                sprintf(self::ERROR_INVALID_LANGUAGE_CODE, $languageCode)
            );
        }

        return Translation::fromArray(
            include $this->translationDirectory() . DIRECTORY_SEPARATOR . $translations[$languageCode]
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
        $localeSettings = array(
            setlocale(LC_TIME, 0), setlocale(LC_CTYPE, 0), getenv('LANG')
        );

        $possibleLocales = array_filter(
            $localeSettings,
            function($localeCode) {
                return $localeCode !== self::DEFAULT_SCRIPT_LOCALE;
            }
        );

        if ($firstMatchingLocale = reset($possibleLocales)) {
            $translations = $this->translations();
            $localeParts = preg_split('~[._]{1}~', $firstMatchingLocale);
            foreach ($localeParts as $languageCode) {
                if (isset($translations[$languageCode])) {
                    return $languageCode;
                }
            }
        }

        return self::DEFAULT_FALLBACK_LOCALE;
    }
}
