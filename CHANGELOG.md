# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## [0.7.2] - 2017-11-10
### Fixed
- combobox rendering and brought tests to green.
- radio rendering in bootstrap4.

### Changed
- refactoring of selectMonths.

## [0.7.1] - 2017-11-08
- rendering of subform and labels.

## [0.7.0] - 2017-10-13
### Added
- beginnings of TailwindCSS framework compatibility.

## [0.6.15] - 2017-11-08
### Fixed
- rendering of subforms in bootstrap4.

## [0.6.14] - 2017-11-08
### Added
- names format option for `@selectMonths`.

## [0.6.13] - 2017-11-07
### Fixed
- passing classes to labels.

## [0.6.12] - 2017-11-06
### Removed
- errant routes for vue components. Will add back in once components are in place. (Got ahead of myself here.)

## [0.6.11] - 2017-11-04
### Fixed
- multiple rendering issues around labels and combo-boxes.

## [0.6.10] - 2017-11-03
### Fixed
- label rendering issue.


## [0.6.9] - 2017-10-13
### Changed
- class structure by refactoring each form component out to its own class.

## [0.6.8] - 2017-10-08
### Fixed
- radio button component missing in bootstrap view.

## [0.6.7] - 2017-10-08
### Added
- initial implementation of `@range` input field.
- initial implementation of `@color` input field.
- initial implementation of `@search` input field.
- initial implementation of `@week` input field.
- initial implementation of `@month` input field.
- initial implementation of `@tel` input field.

## [0.6.6] - 2017-10-08
### Added
- feature tests and unit tests.
- `@number` form field.
- `@selectMonths` form field.
- `@selectWeekday` form field.

### Updated
- repo to be analyzed with multiple services, SensioLabs Insight, Scrutinizer, Coveralls, Travis.
- readme with badges.

### Removed
- code used for older Laravel versions.
- `slugify()` method in HTML facade.
- the HTML facade and class, instead directly referencing Laravel Collective's.
