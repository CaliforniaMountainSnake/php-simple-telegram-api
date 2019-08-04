# Changelog
The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## [Unreleased]
### Added
### Changed
### Deprecated
### Removed
### Fixed
### Security


## [1.2.3] - 2019-08-04
### Fixed
- Fixed the bug.

## [1.2.2] - 2019-08-04
### Added
- Added the SimpleTelegramApi::getBotUsername() and SimpleTelegramApi::getChat() methods.

## [1.2.1] - 2019-08-03
### Added
- Added the SimpleTelegramApi::getMe() method.

## [1.2.0] - 2019-07-14
### Added
- Added this changelog.
### Changed
- Changed vlucas/phpdotenv version to ~3.4 (from ^2.2) to be compatible with its modern version, used in the laravel/framework 5.8.
- Changed minimal php version to ^7.2 (from ^7.3.1).
### Fixed
- Fixed an error in the SimpleTelegramApiTest. Added forgotten "@" character in the chat_id string.
