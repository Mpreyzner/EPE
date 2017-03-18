<?php
namespace mpreyzner\EasyPasswordExterminator\tests;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/PasswordValidator.php';
require_once __DIR__ . '/../src/Spellchecker.php';

use mpreyzner\EasyPasswordExterminator\PasswordValidator;
use mpreyzner\EasyPasswordExterminator\Spellchecker;
use PHPUnit\Framework\TestCase;

class PasswordValidatorTest extends TestCase
{
    protected $validator;

    /**
     * @test
     */
    public function isEasy_shoulFilter()
    {

        $validator = $this->getValidator();
        $word = 'jordan';

        $result = $validator->isEasy($word);

        $this->assertEquals(true, $result);
    }

    public function easyPasswordDataProvider()
    {
        return [
            ['jordan', true],
            //word from the pass list
            ['qwerty', true],
            //keyboard patter
            ['baseball', true],
            //single word
            ['defedf', true],
            //less than 4 unique chars
            ['hello1', true],
        ];
    }

    public function hardPasswordDataProvider()
    {
        return [
            ['mosessupppouseshistoesareroses', false],
            //word from the pass list
            ['AtENDOlaDISh', false],
            //generated pronouncable password
            ['iam`12vEry9)hardpsrd', false],
            ['qwER43@!', false],
            ['Tr0ub4dour&3', false],
        ];
    }
    /**
     * @test
     * dataProvider easyPasswordDataProvider
     * @dataProvider hardPasswordDataProvider
     */
    public function test($password, $expected)
    {
        $validator = $this->getValidator();

        $result = $validator->isEasy($password);

        $this->assertEquals($expected, $result);
    }

    public function getValidator()
    {
        if (empty($this->validator)) {
            $this->validator = new PasswordValidator(new Spellchecker());
        }
        return $this->validator;
    }

}
