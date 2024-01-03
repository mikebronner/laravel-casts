<?php namespace GeneaLabs\LaravelCasts;

use Brick\PhoneNumber\PhoneNumber;
use Illuminate\Support\Str;

class Tel extends Input
{
    public string $countryCode;
    public string $format;

    public function __construct(
        string $name,
        string $value = null,
        public ?string $country = null,
    ) {
        parent::__construct($name, $value, []);

        $this->country = $country
            ?: "US";
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
