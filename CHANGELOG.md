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


## [2.0.6] - 2019-09-08
### Added
- Added the MessageEntitiesUtils trait with method getTelegramMessageTextWithEntities() allows to covert message entities to html (or other preset), if the message contains text/caption with entities.
### Changed
- Updated composer dependencies.

## [2.0.5] - 2019-09-08
### Added
- Added the MessageEntityTypesEnum class represents the type of one special entity in a text message. For example, hashtags, usernames, URLs, etc.

## [2.0.4] - 2019-09-07
### Changed
- Some changes with methods' signatures.

## [2.0.3] - 2019-09-06
### Added
- Added the method SimpleTelegramApi::editMessageText().
### Changed
- Some fixes with enums.

## [2.0.2] - 2019-09-06
### Added
- Added the method SimpleTelegramApi::editMessageMedia().

## [2.0.1] - 2019-08-28
### Added
- Added the methods of TelegramResponse: __toString() and toArray().

## [2.0.0] - 2019-08-28
### Added
- !!! Each api method now returns the TelegramResponse object.
- Added a method SimpleTelegramApi::sendMediafile() intended to send a various types of media files.
- SimpleTelegramApi class also include the SendMediafilesMethods trait contains the sendPhoto, sendAudio, sendVoice, sendDocument, sendVideo, sendAnimation, sendVideoNote methods.
- Added the sendChatAction, sendPoll api methods.
### Changed
- !!! SimpleTelegramApi::sendQuery() method now throws the TelegramWrongResponseException if telegram response was failed.
- !!! ParseModeEnum class moved into the Enums namespace.
- The parameter $_postfields in the SimpleTelegramApi::sendQuery() method is optional now.
- The version of library californiamountainsnake/php-utils has been increased to ~1.0.2.

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
