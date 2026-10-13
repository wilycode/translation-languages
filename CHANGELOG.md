# Changelog

All notable changes to WilyCode Translation Languages are documented here.

## [0.1.0] - 2026-10-13

### Added

- Pluralization rules for **25 languages**, with a separate `PtBr` rule for Brazilian Portuguese.
- **27 regional configurations** including `en-US`, `en-GB`, `pt-PT` and `pt-BR`.
- Locale configuration files and language-only aliases for selective use in applications.
- Localized long-date month names and region-specific separators, currencies and date formats.
- Indian grouping for `hi-IN`, alongside standard Western grouping elsewhere.
- `LocaleFormatterFactory` with locale fallbacks, custom resource directories and safe identifier validation.
- Examples demonstrating how to add Indonesian (`id-ID`) without changing `vendor/`.
- PHPUnit coverage, GitHub Actions, and detailed English documentation.

### Notes

- Plural indexes are zero-based and can differ by language. The interface supports non-negative integer cardinal counts, not fractional CLDR categories.
- Formatting is lightweight and does not replicate the full ICU/CLDR formatting engine.

[0.1.0]: https://github.com/wilycode/translation-languages/releases/tag/v0.1.0
