<?php

declare(strict_types=1);

namespace GeneaLabs\LaravelCasts\View\Components;

use Brick\PhoneNumber\PhoneNumber;
use Illuminate\Support\Str;

class Tel extends Input
{
    public string $countryCode;
    public string $format;

    public function __construct(
        string $name,
        public ?string $country = null,
        ?string $value = null,
        ?string $labelClasses = "",
        ?string $groupClasses = "",
        ?string $errorClasses = "",
        ?string $helpClasses = "",
        ?string $helpText = "",
        ?string $label = null,
    ) {
        $this->country = $country
            ?: "US";
        $examplePhoneNumber = PhoneNumber::getExampleNumber($this->country);
        $this->countryCode = $examplePhoneNumber->getCountryCode();
        $this->format = $examplePhoneNumber->formatForCallingFrom($this->country);
        $this->format = trim(Str::replaceFirst($this->countryCode, "", $this->format));
        $this->format = preg_replace("/\d/", "9", $this->format);

        parent::__construct($name, $value, $label, $labelClasses, $groupClasses, $errorClasses, $helpClasses, $helpText);
    }
}
