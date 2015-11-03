<?php

namespace spec\Technodelight\TimeAgo;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TranslationLoaderSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Technodelight\TimeAgo\TranslationLoader');
    }

    function it_is_able_to_locate_default_translations_directory()
    {
        $this->translationDirectory()->shouldEndWith('/../../translations');
    }

    function it_accepts_a_translation_directory()
    {
        $this->translationDirectory('/whatever/path/to/my-custom-translations');
        $this->translationDirectory()->shouldBeLike('/whatever/path/to/my-custom-translations');
    }

    function it_can_return_translation_directory_contents()
    {
        $this->translations()->shouldBeLike(array(
            'da' => 'da.php',
            'de' => 'de.php',
            'en' => 'en.php',
            'hu' => 'hu.php',
            'nl' => 'nl.php',
            'zh_CN' => 'zh_CN.php',
        ));
    }

    function it_could_load_a_translation()
    {
        $this->load('en')->shouldHaveType('Technodelight\TimeAgo\Translation');
    }

    function it_throws_an_exception_if_no_language_file_found()
    {
        $this->shouldThrow('Technodelight\TimeAgo\Exception\InvalidLanguageCodeException')
            ->duringLoad('non-existent-language');
    }

    function it_is_able_to_detect_language_code_based_on_environment_settings()
    {
        $previousLocale = setlocale(LC_ALL, 0);
        setLocale(LC_TIME, 'de_DE.UTF-8');
        $this->detectLanguage()->shouldContain('de');
        setlocale(LC_ALL, $previousLocale);
    }

    function it_is_able_to_construct_a_default_translation()
    {
        $this->loadDefault()->shouldHaveType('Technodelight\TimeAgo\Translation');
    }

    function getMatchers()
    {
        return array(
            'contain' => function($subject, $expectation) {
                return strpos($subject, $expectation) !== false;
            }
        );
    }
}
