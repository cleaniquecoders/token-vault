<?php

namespace CleaniqueCoders\TokenVault\Enums;

use CleaniqueCoders\Traitify\Concerns\InteractsWithEnum;
use CleaniqueCoders\Traitify\Contracts\Enum as Contract;

enum Provider: string implements Contract
{
    use InteractsWithEnum;

    case GitHub = 'github';
    case GitLab = 'gitlab';
    case Bitbucket = 'bitbucket';
    case Stripe = 'stripe';
    case Slack = 'slack';
    case Mailgun = 'mailgun';
    case AWS = 'aws';
    case Sentry = 'sentry';
    case Vercel = 'vercel';
    case Kong = 'Kong';

    public function label(): string
    {
        return match ($this) {
            self::GitHub => __('GitHub'),
            self::GitLab => __('GitLab'),
            self::Bitbucket => __('Bitbucket'),
            self::Stripe => __('Stripe'),
            self::Slack => __('Slack'),
            self::Mailgun => __('Mailgun'),
            self::AWS => __('AWS'),
            self::Sentry => __('Sentry'),
            self::Vercel => __('Vercel'),
            self::Kong => __('Kong'),
        };
    }

    public function description(): string
    {
        return match ($this) {
            self::GitHub => __('GitHub is a source code hosting platform.'),
            self::GitLab => __('GitLab is a DevOps platform for collaboration.'),
            self::Bitbucket => __('Bitbucket is Git code management for teams.'),
            self::Stripe => __('Stripe processes online payments securely.'),
            self::Slack => __('Slack is a messaging platform for teams.'),
            self::Mailgun => __('Mailgun provides email APIs for developers.'),
            self::AWS => __('Amazon Web Services - cloud infrastructure provider.'),
            self::Sentry => __('Sentry helps monitor and fix crashes in real time.'),
            self::Vercel => __('Vercel is a platform for frontend frameworks and static sites.'),
            self::Kong => __('Kong Gateway is a lightweight, fast, and flexible cloud-native API gateway and reverse proxy.'),
        };
    }
}
