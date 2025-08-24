<?php

namespace CleaniqueCoders\TokenVault\Enums;

use CleaniqueCoders\Traitify\Concerns\InteractsWithEnum;
use CleaniqueCoders\Traitify\Contracts\Enum as Contract;

enum Type: string implements Contract
{
    use InteractsWithEnum;

    case AccessToken = 'access_token';
    case ApiKey = 'api_key';
    case BearerToken = 'bearer_token';
    case RefreshToken = 'refresh_token';
    case PersonalAccessToken = 'personal_access_token';
    case ServiceAccountKey = 'service_account_key';
    case WebhookSecret = 'webhook_secret';
    case EncryptionKey = 'encryption_key';
    case CertificateKey = 'certificate_key';
    case DatabasePassword = 'database_password';
    case BasicAuth = 'basic_auth';
    case OAuthToken = 'oauth_token';

    public function label(): string
    {
        return match ($this) {
            self::AccessToken => __('Access Token'),
            self::ApiKey => __('API Key'),
            self::BearerToken => __('Bearer Token'),
            self::RefreshToken => __('Refresh Token'),
            self::PersonalAccessToken => __('Personal Access Token'),
            self::ServiceAccountKey => __('Service Account Key'),
            self::WebhookSecret => __('Webhook Secret'),
            self::EncryptionKey => __('Encryption Key'),
            self::CertificateKey => __('Certificate Key'),
            self::DatabasePassword => __('Database Password'),
            self::BasicAuth => __('Basic Authentication'),
            self::OAuthToken => __('OAuth Token'),
        };
    }

    public function description(): string
    {
        return match ($this) {
            self::AccessToken => __('A token that grants access to protected resources.'),
            self::ApiKey => __('A unique identifier used to authenticate API requests.'),
            self::BearerToken => __('A security token carried in the authorization header.'),
            self::RefreshToken => __('A token used to obtain new access tokens.'),
            self::PersonalAccessToken => __('A token created by users for programmatic access.'),
            self::ServiceAccountKey => __('A key used for service-to-service authentication.'),
            self::WebhookSecret => __('A secret used to verify webhook authenticity.'),
            self::EncryptionKey => __('A key used for encrypting and decrypting data.'),
            self::CertificateKey => __('A private key associated with a digital certificate.'),
            self::DatabasePassword => __('A password for database connection authentication.'),
            self::BasicAuth => __('Username and password credentials for basic authentication.'),
            self::OAuthToken => __('A token issued by an OAuth authorization server.'),
        };
    }
}
