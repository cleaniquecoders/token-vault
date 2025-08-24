# Changelog

All notable changes to `token-vault` will be documented in this file.

## Enhanced Token Type Management  - 2025-08-24

### v1.1.0 - Enhanced Token Type Management - 2025-08-24

#### 🎉 What's New

##### ✨ New Token Type Enum

- **Added comprehensive `Type` enum** with 12 predefined token types for better categorization
- Supports common authentication methods: `AccessToken`, `ApiKey`, `BearerToken`, `RefreshToken`, `PersonalAccessToken`, `ServiceAccountKey`, `WebhookSecret`, `EncryptionKey`, `CertificateKey`, `DatabasePassword`, `BasicAuth`, `OAuthToken`
- Each type includes descriptive labels and detailed descriptions for better UX

##### 🔧 Enhanced Configuration

- **Updated configuration structure** with organized sections and comprehensive documentation
- Added `type` configuration option to specify custom Type enum classes
- Improved configuration comments with Laravel-style documentation blocks
- Better logical grouping: Core Components, Enumerations, and Caching Configuration

##### 📚 Comprehensive Documentation

- **Completely rewritten README** with extensive usage examples
- Added detailed sections for both `Provider` and `Type` enums
- New advanced usage patterns: token rotation, expiration management, metadata queries
- Enhanced code examples with real-world scenarios (GitHub PATs, Stripe API keys, AWS credentials)
- Added security best practices and warnings

##### 🐛 Bug Fixes

- Fixed Kong provider enum value consistency (`'kong'` instead of `'Kong'`)
- Corrected trait namespace reference in documentation

#### 🔄 Changes

##### Provider Enum Updates

- Maintains all existing providers: GitHub, GitLab, Bitbucket, Stripe, Slack, Mailgun, AWS, Sentry, Vercel, Kong
- Fixed case consistency in enum values

##### Breaking Changes

- **None** - This release is fully backward compatible

#### 📖 Migration Guide

No migration required for existing installations. New `Type` enum is optional and provides additional categorization capabilities.

```php
// Before (still works)
$user->tokens()->create([
    'provider' => Provider::GitHub,
    'type' => 'access_token', // string value
    'token' => 'ghp_...',
]);

// Enhanced (recommended)
$user->tokens()->create([
    'provider' => Provider::GitHub,
    'type' => Type::PersonalAccessToken, // enum value
    'token' => 'ghp_...',
]);

```
#### 🎯 Use Cases

This release enhances the package for:

- **Enterprise applications** requiring detailed token categorization
- **Multi-service integrations** with various authentication methods
- **Security-conscious applications** needing comprehensive token management
- **Development teams** requiring clear token type documentation

**Full Changelog**: https://github.com/cleaniquecoders/token-vault/compare/1.0.1...1.1.0

## Make model and provider configurable - 2025-07-31

**Full Changelog**: https://github.com/cleaniquecoders/token-vault/compare/1.0.0...1.0.1

## First Release - 2025-07-19

### What's Changed

* Bump stefanzweifel/git-auto-commit-action from 5 to 6 by @dependabot[bot] in https://github.com/cleaniquecoders/token-vault/pull/1

### New Contributors

* @dependabot[bot] made their first contribution in https://github.com/cleaniquecoders/token-vault/pull/1

**Full Changelog**: https://github.com/cleaniquecoders/token-vault/commits/1.0.0
