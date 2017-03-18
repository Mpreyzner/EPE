<?php
namespace EasyPasswordExterminator;

class PasswordValidator
{
    /** @var Spellchecker  */
    protected $spellchecker;

    /** @var array  */
    protected $errorMessages = [];

    public function __construct(Spellchecker $pspspell)
    {
        $this->spellchecker = $pspspell;
    }

    public function isEasy(string $pass): bool
    {

        if (is_numeric($pass)) {
            $this->addError("Password shouldn't be a plain number.");
            return true;
        }

        $minLength = 6;
        if (strlen($pass) < $minLength) {
            $this->addError("Password is too short. It should be at least {$minLength} characters.");
            return true;
        }
        if (count(array_unique(str_split($pass))) < 4) {
            $this->addError("Password is too easy. It should contain more unique characters.");
            return true;
        }

        if ($this->spellchecker->isWord($pass)) {
            $this->addError("Password is too easy. It shouldn't be a single word.");
            return true;
        }
        if ($this->isPopular($pass)) {
            $this->addError("Password is too popular.");
            return true;
        }

        if (!empty($this->spellchecker->didYouMean($pass))) {
            $this->addError("Password is too easy.");
            return true;
        }

        return false;
    }

    protected function addError(string $error) : void
    {
        $this->errorMessages[] = $error;
    }

    public function getAllErrors() : string
    {
        $allErrors = implode(' ', $this->errorMessages);
        return $allErrors;
    }

    protected function isPopular(string $string): bool
    {
        $popularPasswords = ['michael' => 0, 'jordan' => 1, 'jennifer' => 2, 'harley' => 3, 'andrew' => 4, 'robert' => 5, 'thomas' => 6, 'daniel' => 7, 'michelle' => 8, 'jessica' => 9, 'maggie' => 10, 'joshua' => 11, 'ashley' => 12, 'nicole' => 13, 'chelsea' => 14, 'matthew' => 15, 'yankees' => 16, 'austin' => 17, 'taylor' => 18, 'william' => 19, 'merlin' => 20, 'anthony' => 21, 'justin' => 22, 'patrick' => 23, 'richard' => 24, 'samantha' => 25, 'jackson' => 26, 'morgan' => 27, 'ferrari' => 28, 'samsung' => 29, 'andrea' => 30, 'joseph' => 31, 'mercedes' => 32, 'dakota' => 33, 'melissa' => 34, 'nascar' => 35, 'compaq' => 36, 'porsche' => 37, 'boston' => 38, 'brandon' => 39, 'chester' => 40, 'edward' => 41, 'oliver' => 42, 'nikita' => 43, 'chicago' => 44, 'charles' => 45, 'rachel' => 46, 'steven' => 47, 'victoria' => 48, 'natasha' => 49, 'marlboro' => 50, 'lauren' => 51, 'angela' => 52, 'madison' => 53, 'winston' => 54, 'shannon' => 55, 'sophie' => 56, 'pokemon' => 57, 'johnson' => 58, 'murphy' => 59, 'jonathan' => 60, 'danielle' => 61, 'jackie' => 62, 'carlos' => 63, 'dennis' => 64, 'cameron' => 65, 'gemini' => 66, 'wilson' => 67, 'sandra' => 68, 'florida' => 69, 'liverpool' => 70, 'nicholas' => 71, 'tiffany' => 72, 'maxwell' => 73, 'jeremy' => 74, 'monica' => 75, 'albert' => 76, 'alexis' => 77, 'samson' => 78, 'scorpio' => 79, 'bonnie' => 80, 'benjamin' => 81, 'dexter' => 82, 'calvin' => 83, 'freddy' => 84, 'sydney' => 85, 'gordon' => 86, 'stella' => 87, 'arthur' => 88, 'america' => 89, 'parker' => 90, 'garfield' => 91, 'december' => 92, 'skippy' => 93, 'shelby' => 94, 'godzilla' => 95, 'brooklyn' => 96, 'xavier' => 97, 'travis' => 98, 'pakistan' => 99, 'walter' => 100, 'saturn' => 101, 'williams' => 102, 'nintendo' => 103, 'marvin' => 104, 'guinness' => 105, 'november' => 106, 'celtic' => 107, 'cassie' => 108, 'donald' => 109, 'beatles' => 110, 'louise' => 111, 'gabriel' => 112, 'spencer' => 113, 'gibson' => 114, 'metallica' => 115, 'samuel' => 116, 'montana' => 117, 'mexico' => 118, 'michigan' => 119, 'carolina' => 120, 'yankee' => 121, 'kimberly' => 122, 'sharon' => 123, 'carmen' => 124, 'kristina' => 125, 'sabrina' => 126, 'marcus' => 127, 'qweasdzxc' => 128, 'caroline' => 129, 'einstein' => 130, 'vanessa' => 131, 'friday' => 132, 'stephen' => 133, 'october' => 134, 'gregory' => 135, 'pamela' => 136, 'stanley' => 137, 'courtney' => 138, 'patricia' => 139, 'teresa' => 140, 'mozart' => 141, 'buddha' => 142, 'anderson' => 143, 'melanie' => 144, 'denise' => 145, 'simpsons' => 146, 'olivia' => 147, 'cherokee' => 148, 'vincent' => 149, 'frankie' => 150, 'douglas' => 151, 'suzuki' => 152, 'scotland' => 153, 'natalie' => 154, 'marley' => 155, 'allison' => 156, 'marshall' => 157, 'adrian' => 158, 'antonio' => 159, 'howard' => 160, 'franklin' => 161, 'alexander' => 162, 'jupiter' => 163, 'claudia' => 164, 'russia' => 165, 'kawasaki' => 166, 'vladimir' => 167, 'francis' => 168, 'disney' => 169, 'brittany' => 170, 'brutus' => 171, 'norman' => 172, 'monday' => 173, 'duncan' => 174, 'jeffrey' => 175, 'brooke' => 176, 'karina' => 177, 'colorado' => 178, 'motorola' => 179, 'ireland' => 180, 'houston' => 181, 'bradley' => 182, 'kermit' => 183, 'avalon' => 184, 'simpson' => 185, 'madonna' => 186, 'claire' => 187, 'zachary' => 188, 'brenda' => 189, 'russell' => 190, 'georgia' => 191, 'virginia' => 192, 'valentin' => 193, 'arizona' => 194, 'mitchell' => 195, 'christ' => 196, 'baxter' => 197, 'roland' => 198, 'arnold' => 199, 'fktrcfylh' => 200, 'denver' => 201, 'hobbes' => 202, 'alison' => 203, 'burton' => 204, 'newport' => 205, 'american' => 206, 'hendrix' => 207, 'england' => 208, 'brazil' => 209];
        return array_key_exists($string, $popularPasswords);
    }
}
