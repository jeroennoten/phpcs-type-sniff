# Changelog

All notable changes to `phpcs-type-sniff` will be documented in this file.

Updates should follow the [Keep a CHANGELOG](http://keepachangelog.com/) principles.

## 0.14.1 - 2020-04-14
### Fixed
- Doc type `resource` cannot be type declaration, do not require
- Nullable basic getter warning when no dock block does not contain tags

## 0.14.0 - 2020-02-26
### Added
- Warning for uninitialized class/trait property. Default value and assignments in `__construct()` are checked. Adding null doc type is suggested.
- Warning for nullable return types for basic getters based on property doc type.
- Setting `FqcnPropSniff.reportUninitializedProp`
- Setting `FqcnPropSniff.reportNullableBasicGetter`

## 0.13.1 - 2020-01-17
### Added
- Warning for undefined type typed array, e.g. []|null
### Fixed
- Parsing of undefined type typed array, e.g. [][]

## 0.13.0 - 2019-12-09
### Removed
- Setting `FqcnMethodSniff.usefulTags`
### Added
- Parsing of alternative PHPDoc array types (array shapes, object-like arrays) as mixed[]
- Setting `FqcnMethodSniff.invalidTags`. Specifies which methods tags should be removed.
- Setting `FqcnMethodSniff.reportMissingTags`.
### Fixed
- Parsing of compound typed array types, e.g. (int[]|string)[]
- Parsing of generic tags with parentheses, no longer part of tag name, Dynamic content is now tag content.
- All tags except `param`, `return` make method PHPDoc useful.

## 0.12.4 - 2019-11-21
### Fixed
- Useless PHPDoc for const is no longer reported when doc type is incomplete (e.g. array)

## 0.12.3 - 2019-11-15
### Fixed
- Fix PHPDoc tag parsing which are prefaced with multiple spaces

## 0.12.2 - 2019-08-07
### Fixed
- FqcnConstSniff now checks for other tags before declaring useless PHPDoc.

## 0.12.1 - 2019-07-31
### Fixed
- TypedArrayType is now covers FqcnType, e.g. @return Collection|Image[] -> :Collection

## 0.12.0 - 2019-07-29
### Added
- Detection for "parent" type
- Warning when only using null parameter doc type, compound type is suggested
- Warning when using null return type, removal or compound type is suggested
- Warning for doc types that are incompatible with declared function types
- More accurate warning for missing doc types (detected from function type)
- Nullable function type is suggested from null doc type
- Warning when using return void tag when type declaration is specified
- Warning for incomplete type array types, e.g. array[]
- Warning for wrong, missing types in const, PHPDoc tags.
- Useless FQCN description warning
- Useless __construct description warning
- Detection of function parameter default value type
- Warning for redundant doc types, e.g. float|double
- Warning to use nullable parameter type instead of type + null default value
- Warning for useless const PHPDoc
### Changed
- self, typed array type examples when for missing function type warnings
- FqcnMethodSniff logic. Removed dead end inspection paths, code duplication
- Updated warnings texts
### Fixed
- ResourceType is now DocBlock type, because cannot be used as PHP type declaration
- If @param is missing, doc block is not deemed useless, but needs to be fixed

## 0.11.1 - 2019-07-12
### Fixed
- Typed array prop, const check when compound type is used

## 0.11.0 - 2019-07-10
### Added
- Default value type for prop elements
- Value type for const elements
- Array type warnings for const elements, prop elements
### Fixed
- ParseError is now ignored when using reflection
- Trait prop detection
- Sniff toggling using "*.enabled" config option
### Removed
- Variable name check for const elements

## 0.10.5 - 2019-06-14
### Added
- Added warning for array type inside compound parameter type

## 0.10.4 - 2019-06-09
### Fixed
- Parameter default value detection when self, double colon is used

## 0.10.3 - 2019-05-27
### Fixed
- Useless doc block detection when comparing `CompoundType` and `NullableType`, raw types are now sorted.

## 0.10.2 - 2019-05-27
### Fixed
- Usage of FqcnMethodSniff.usefulTags config option

## 0.10.1 - 2019-05-27
### Fixed
- Added support for tags with parentheses, e.g. @SmartTemplate()

## 0.10.0 - 2019-05-27
### Added
- Description "ClassA Constructor." is now ignored and not considered useful
- Configuration for `CompositeCodeElementSniff`
- Ability to add and configure custom `CodeElementSniffInterface` sniffs
- Option `useReflection`
- Option `sniffs`
- Option `FqcnMethodSniff.usefulTags`
### Fixed
- ReturnTag::getDescription()
- FunctionParam::getParam()
- FunctionParam::hasParam()
- SelfType::__construct()

## 0.9.0 - 2019-05-06
### Added
- Initial release
