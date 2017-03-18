[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Mpreyzner/EPE/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Mpreyzner/EPE/?branch=master)
### Tested with passwords from https://github.com/danielmiessler/SecLists
10_million_password_list_top_1000000.txt: - marked as easy 934951

Although the script is a bit too agressive at the moment as it marks passwords like qwER43@! and Tr0ub4dour&3 as easy, maybe adding calculating of password entropy will fix that.

# Launch:
sudo apt-get install libpspell-dev 
sudo apt install php7.1-pspell
sudo apt install aspell-en

composer install

## Launch tests:
cd tests/
../vendor/bin/phpunit .

## Sample usage:
```php
$password = 'qwerty';
$validator = new PasswordValidator(new Spellchecker());
$isEasy = $validator->isEasy($password);
if($isEasy) {
	echo $validator->getAllErrors();
}
```

Alternatives:

Frontend - https://github.com/dropbox/zxcvbn#readme

Php - https://github.com/bjeavons/zxcvbn-php