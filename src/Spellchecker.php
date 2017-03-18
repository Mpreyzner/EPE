<?php
namespace EasyPasswordExterminator;

class Spellchecker
{
    /** @var  string 2 characters language code */
    protected $lang;
    
    protected $dictionary;

    public function __construct($lang = 'en', $mode = PSPELL_FAST, $ignoreLength = 3)
    {
        $config_dic = pspell_config_create($lang);
        pspell_config_ignore($config_dic, $ignoreLength);

        pspell_config_mode($config_dic, $mode);
        $this->dictonary = pspell_new_config($config_dic);
        //pspell_config_personal($pspell_config, "/tmp/dicts/newdict");
    }

    public function getSuggestions(string $string): array
    {
        return pspell_suggest($this->dictonary, $string);
    }

    public function isWord(string $string): bool
    {
        return pspell_check($this->dictonary, $string);
    }

    public function didYouMean(string $input): string
    {
        $replacements = [];
        $words = explode(' ', trim(str_replace(',', ' ', $input)));

        foreach ($words as $index => $word) {
            if (!$this->isWord($word)) {
                $firstSuggestion = $this->getFirstSuggestion($word);
                if (!empty($firstSuggestion)) {
                    $replacements[$index] = $firstSuggestion;
                }
            }
        }
        return implode('', $replacements);
    }

    protected function getFirstSuggestion(string $word): string
    {
        $replacement = '';
        $suggestions = $this->getSuggestions($word);

        if (!empty($suggestions) && array_key_exists(0, $suggestions)) {
            $areEqual = (mb_strtolower($suggestions[0]) == mb_strtolower($word));
            if (!$areEqual) {
                $replacement = $suggestions[0];
            }
        }
        return $replacement;
    }
}
