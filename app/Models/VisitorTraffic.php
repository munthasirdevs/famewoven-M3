<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VisitorTraffic extends Model
{
    use HasFactory;

    protected $table = 'visitor_traffic';

    protected $fillable = [
        'visitor_id',
        'session_id',
        'user_id',
        'method',
        'path',
        'url',
        'referer',
        'referer_domain',
        'ip_address',
        'user_agent',
        'device_type',
        'browser',
        'os',
        'country',
        'status_code',
        'is_bot',
    ];

    protected $casts = [
        'status_code' => 'integer',
        'is_bot' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * User relationship (if authenticated)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Query Scopes
     */
    public function scopeHumans($query)
    {
        return $query->where('is_bot', false);
    }

    public function scopeBots($query)
    {
        return $query->where('is_bot', true);
    }

    public function scopePeriod($query, string $period = '30d')
    {
        return match ($period) {
            'today' => $query->whereDate('created_at', today()),
            '24h' => $query->where('created_at', '>=', now()->subHours(24)),
            '7d' => $query->where('created_at', '>=', now()->subDays(7)),
            '30d' => $query->where('created_at', '>=', now()->subDays(30)),
            '90d' => $query->where('created_at', '>=', now()->subDays(90)),
            'all' => $query,
            default => $query->where('created_at', '>=', now()->subDays(30)),
        };
    }

    /**
     * Anonymize IP address for strict GDPR & privacy compliance.
     * Replaces the last octet of IPv4 addresses with .xxx and masks IPv6 host bits.
     */
    public static function anonymizeIp(?string $ip): ?string
    {
        if (empty($ip)) {
            return null;
        }

        // IPv4 (e.g., 192.168.1.100 -> 192.168.1.xxx)
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            $parts = explode('.', $ip);
            if (count($parts) === 4) {
                $parts[3] = 'xxx';
                return implode('.', $parts);
            }
        }

        // IPv6 (e.g., 2001:db8:85a3::8a2e:370:7334 -> 2001:db8:85a3:0000:xxxx:xxxx:xxxx:xxxx)
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            $expanded = inet_ntop(inet_pton($ip));
            if ($expanded !== false) {
                $parts = explode(':', $expanded);
                if (count($parts) >= 4) {
                    return $parts[0] . ':' . $parts[1] . ':' . $parts[2] . ':xxxx:xxxx';
                }
            }
            return 'xxxx:xxxx:xxxx:xxxx';
        }

        return '127.0.0.xxx';
    }

    /**
     * Detect device type safely without heavy external libraries.
     */
    public static function detectDeviceType(?string $userAgent): string
    {
        if (empty($userAgent)) {
            return 'desktop';
        }

        $ua = strtolower($userAgent);

        if (self::isBotUserAgent($ua)) {
            return 'bot';
        }

        if (str_contains($ua, 'ipad') || str_contains($ua, 'tablet') || str_contains($ua, 'playbook') || str_contains($ua, 'silk')) {
            return 'tablet';
        }

        if (str_contains($ua, 'mobile') || str_contains($ua, 'android') || str_contains($ua, 'iphone') || str_contains($ua, 'ipod') || str_contains($ua, 'blackberry') || str_contains($ua, 'windows phone')) {
            return 'mobile';
        }

        return 'desktop';
    }

    /**
     * Detect if user agent belongs to a known crawler/bot.
     */
    public static function isBotUserAgent(?string $userAgent): bool
    {
        if (empty($userAgent)) {
            return false;
        }

        $ua = strtolower($userAgent);
        $botSignatures = [
            'bot', 'crawl', 'spider', 'slurp', 'googlebot', 'bingbot', 'yandex',
            'duckduckbot', 'baiduspider', 'facebookexternalhit', 'facebot',
            'twitterbot', 'rogerbot', 'linkedinbot', 'embedly', 'quora link preview',
            'showyoubot', 'outbrain', 'pinterest', 'slackbot', 'vkshare', 'w3c_validator',
            'semrush', 'ahrefs', 'mj12bot', 'petalbot', 'bytespider', 'dotbot', 'zoominfobot'
        ];

        foreach ($botSignatures as $sig) {
            if (str_contains($ua, $sig)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Detect Browser Name from User Agent.
     */
    public static function detectBrowser(?string $userAgent): string
    {
        if (empty($userAgent)) {
            return 'Unknown';
        }

        $ua = $userAgent;

        if (self::isBotUserAgent($ua)) {
            return 'Crawler / Bot';
        }

        if (preg_match('/Edg(?:e)?\/([0-9.]+)/i', $ua)) {
            return 'Microsoft Edge';
        }

        if (preg_match('/OPR\/([0-9.]+)/i', $ua) || preg_match('/Opera\/([0-9.]+)/i', $ua)) {
            return 'Opera';
        }

        if (preg_match('/Chrome\/([0-9.]+)/i', $ua) && !preg_match('/Edg/i', $ua)) {
            return 'Google Chrome';
        }

        if (preg_match('/Firefox\/([0-9.]+)/i', $ua)) {
            return 'Mozilla Firefox';
        }

        if (preg_match('/Safari\/([0-9.]+)/i', $ua) && !preg_match('/Chrome/i', $ua)) {
            return 'Apple Safari';
        }

        if (preg_match('/MSIE|Trident/i', $ua)) {
            return 'Internet Explorer';
        }

        return 'Other';
    }

    /**
     * Detect Operating System from User Agent.
     */
    public static function detectOs(?string $userAgent): string
    {
        if (empty($userAgent)) {
            return 'Unknown';
        }

        $ua = $userAgent;

        if (preg_match('/Windows NT 10/i', $ua)) {
            return 'Windows 10/11';
        }
        if (preg_match('/Windows NT 6.3/i', $ua)) {
            return 'Windows 8.1';
        }
        if (preg_match('/Windows NT 6.1/i', $ua)) {
            return 'Windows 7';
        }
        if (preg_match('/Windows/i', $ua)) {
            return 'Windows';
        }
        if (preg_match('/iPhone|iPad|iPod/i', $ua)) {
            return 'iOS';
        }
        if (preg_match('/Mac OS X|Macintosh/i', $ua)) {
            return 'macOS';
        }
        if (preg_match('/Android/i', $ua)) {
            return 'Android';
        }
        if (preg_match('/Linux/i', $ua)) {
            return 'Linux';
        }
        if (preg_match('/CrOS/i', $ua)) {
            return 'Chrome OS';
        }

        return 'Other';
    }

    /**
     * Extract human-readable referer domain.
     */
    public static function extractRefererDomain(?string $referer, ?string $currentHost = null): string
    {
        if (empty($referer)) {
            return 'Direct / None';
        }

        $parsed = parse_url($referer);
        if (empty($parsed['host'])) {
            return 'Direct / None';
        }

        $host = strtolower($parsed['host']);
        $host = preg_replace('/^www\./', '', $host);

        if ($currentHost && (str_contains($host, $currentHost) || str_contains($currentHost, $host))) {
            return 'Internal Navigation';
        }

        // Common social/search shortcuts for cleaner analytics
        if (str_contains($host, 'google.')) return 'Google Search';
        if (str_contains($host, 'bing.')) return 'Bing Search';
        if (str_contains($host, 'duckduckgo.')) return 'DuckDuckGo';
        if (str_contains($host, 't.co') || str_contains($host, 'x.com') || str_contains($host, 'twitter.com')) return 'X / Twitter';
        if (str_contains($host, 'linkedin.com') || str_contains($host, 'lnkd.in')) return 'LinkedIn';
        if (str_contains($host, 'instagram.com')) return 'Instagram';
        if (str_contains($host, 'youtube.com')) return 'YouTube';
        if (str_contains($host, 'facebook.com')) return 'Facebook';
        if (str_contains($host, 'reddit.com')) return 'Reddit';
        if (str_contains($host, 'github.com')) return 'GitHub';

        return $host;
    }
}

