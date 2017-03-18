<?php
namespace mpreyzner\EasyPasswordExterminator\tests;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/Spellchecker.php';

use mpreyzner\EasyPasswordExterminator\Spellchecker;
use PHPUnit\Framework\TestCase;

class SpellcheckerTest extends TestCase
{
    protected $spellChecker;
    /**
     * @test
     */
    public function isWord_shouldWork()
    {
        $spellchecker = $this->getSpellchecker();
        $word = 'cat';

        $result = $spellchecker->isWord($word);

        $this->assertEquals(true, $result);
    }

    /**
     * @test
     */
    public function isWord_shouldFail()
    {
        $spellchecker = $this->getSpellchecker();
        $word = '`1234`';

        $result = $spellchecker->isWord($word);

        $this->assertEquals(false, $result);
    }

    /**
     * @test
     */
    public function suggest_shouldWork()
    {
        $spellchecker = $this->getSpellchecker();
        $word = 'cet';

        $result = $spellchecker->getSuggestions($word);

        $this->assertNotEmpty($result);
    }

    /**
     * @test
     */
    public function suggest_shouldFail()
    {

        $spellchecker = $this->getSpellchecker();
        $word = 'qwertyuiop';

        $result = $spellchecker->getSuggestions($word);
        $this->assertEmpty($result);
    }

    /**
     * @test
     */
    public function didYouMean_shouldWork()
    {

        $spellchecker = $this->getSpellchecker();
        $word = 'qwertyuiop';

        $result = $spellchecker->getSuggestions($word);
        $this->assertEmpty($result);
    }

    /**
     * @test
     */
    public function didYouMean_shouldFail()
    {

        $spellchecker = $this->getSpellchecker();
        $word = 'qwertyuiop';

        $result = $spellchecker->getSuggestions($word);
        $this->assertEmpty($result);
    }

    private function getSpellchecker()
    {
        if (empty($this->spellChecker)) {
            $this->spellChecker = new Spellchecker();
        }
        return $this->spellChecker;
    }
}
