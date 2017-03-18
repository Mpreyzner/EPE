Tested with passwords from https://github.com/danielmiessler/SecLists
10_million_password_list_top_1000000.txt:
- marked as easy

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