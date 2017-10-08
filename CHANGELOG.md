# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## [0.6.5] - 2017-10-08
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
