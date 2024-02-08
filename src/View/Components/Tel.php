<?php

declare(strict_types=1);

namespace GeneaLabs\LaravelCasts\View\Components;

use Brick\PhoneNumber\PhoneNumber;
use Brick\PhoneNumber\PhoneNumberType;
use Illuminate\Support\Str;

class Tel extends Input
{
    public string $countryCode;
    public string $format;

    public function __construct(
        string $name,
        public ?string $country = null,
        ?bool $isMobile = null,
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
        $phoneType = match ($isMobile) {
            true => PhoneNumberType::MOBILE,
            false => PhoneNumberType::FIXED_LINE,
            default => PhoneNumberType::FIXED_LINE_OR_MOBILE,
        };
        $examplePhoneNumber = PhoneNumber::getExampleNumber($this->country, $phoneType);
        $this->countryCode = $examplePhoneNumber->getCountryCode();
        $this->format = $examplePhoneNumber->formatForCallingFrom($this->country);
        $this->format = trim(Str::replaceFirst($this->countryCode, "", $this->format));
        $this->format = preg_replace("/\d/", "9", $this->format);

        parent::__construct(
            $name,
            $value,
            $labelClasses,
            $groupClasses,
            $errorClasses,
            $helpClasses,
            $helpText,
            $label,
        );
    }
}
