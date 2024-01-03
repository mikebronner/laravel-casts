<?php namespace GeneaLabs\LaravelCasts;

use Brick\PhoneNumber\PhoneNumber;
use Illuminate\Support\Str;

class Tel extends Input
{
    public string $countryCode;
    public string $format;

    public function __construct(
        public string $country,
        string $name,
        string $value = null,
    ) {
        parent::__construct($name, $value, []);
        $examplePhoneNumber = PhoneNumber::getExampleNumber($country);
        $this->countryCode = $examplePhoneNumber->getCountryCode();
        $this->format = $examplePhoneNumber->formatForCallingFrom($country);
        $this->format = trim(Str::replace($this->countryCode, "", $this->format));
        $this->format = preg_replace("/\d/", "9", $this->format);

        if ($this->framework === 'tailwind') {
            $this->classes .= ' form-input mt-1 block w-full';
        }
    }
}
