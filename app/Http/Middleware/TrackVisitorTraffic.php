<?php

namespace App\Http\Middleware;

use App\Models\VisitorTraffic;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitorTraffic
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Skip admin routes, static assets, internal endpoints, and API test probes
        if ($this->shouldSkipTracking($request)) {
            return $next($request);
        }

        // 2. Check privacy flags (Do Not Track, Global Privacy Control, or Essential-only cookie preference)
        $dntActive = $request->header('DNT') === '1' || $request->header('Sec-GPC') === '1';
        $cookieConsent = $request->cookie('famewoven_cookie_consent');

        if ($dntActive || $cookieConsent === 'essential') {
            // Respect user privacy choice; do not log visitor telemetry
            return $next($request);
        }

        // 3. Obtain or initialize pseudonymous visitor token
        $visitorId = $request->cookie('famewoven_vid');
        $isNewVisitor = false;

        if (empty($visitorId) || strlen($visitorId) < 16) {
            $visitorId = 'fw_' . Str::random(28);
            $isNewVisitor = true;
        }

        // 4. Capture request context
        $path = '/' . ltrim($request->path(), '/');
        $userAgent = $request->userAgent();
        $referer = $request->header('referer');
        $anonymizedIp = VisitorTraffic::anonymizeIp($request->ip());

        $deviceType = VisitorTraffic::detectDeviceType($userAgent);
        $browser = VisitorTraffic::detectBrowser($userAgent);
        $os = VisitorTraffic::detectOs($userAgent);
        $isBot = VisitorTraffic::isBotUserAgent($userAgent);
        $refererDomain = VisitorTraffic::extractRefererDomain($referer, $request->getHost());
        $sessionId = $request->hasSession() ? substr($request->session()->getId(), 0, 32) : null;

        // 5. Run next middleware and retrieve response
        $response = $next($request);

        // 6. Record visitor traffic hit
        try {
            VisitorTraffic::create([
                'visitor_id' => $visitorId,
                'session_id' => $sessionId,
                'user_id' => Auth::id(),
                'method' => $request->method(),
                'path' => $path,
                'url' => substr($request->fullUrl(), 0, 1000),
                'referer' => $referer ? substr($referer, 0, 1000) : null,
                'referer_domain' => $refererDomain,
                'ip_address' => $anonymizedIp,
                'user_agent' => $userAgent ? substr($userAgent, 0, 500) : null,
                'device_type' => $deviceType,
                'browser' => $browser,
                'os' => $os,
                'country' => $this->detectCountry($request),
                'status_code' => $response->getStatusCode(),
                'is_bot' => $isBot,
            ]);
        } catch (\Throwable $e) {
            // Silently capture any tracking errors to ensure public site is never blocked
        }

        // 7. Attach persistent visitor cookie if new
        if ($isNewVisitor && method_exists($response, 'withCookie')) {
            $response->withCookie(
                Cookie::make(
                    'famewoven_vid',
                    $visitorId,
                    60 * 24 * 365, // 1 year
                    '/',
                    null,
                    $request->isSecure(),
                    false, // HttpOnly false so frontend scripts can access identifier if needed
                    false,
                    'Lax'
                )
            );
        }

        return $response;
    }

    /**
     * Determine whether tracking should be skipped.
     */
    protected function shouldSkipTracking(Request $request): bool
    {
        // Don't track admin operations
        if ($request->is('admin') || $request->is('admin/*')) {
            return true;
        }

        // Don't track preflight OPTIONS requests
        if ($request->isMethod('OPTIONS')) {
            return true;
        }

        // Don't track common static asset extensions or telemetry paths
        $skipPatterns = [
            'robots.txt',
            'sitemap.xml',
            'up',
            'favicon.ico',
        ];

        foreach ($skipPatterns as $pattern) {
            if ($request->is($pattern)) {
                return true;
            }
        }

        // Extension check for static files
        $extension = strtolower(pathinfo($request->path(), PATHINFO_EXTENSION));
        $staticExtensions = ['css', 'js', 'png', 'jpg', 'jpeg', 'gif', 'svg', 'ico', 'webp', 'woff', 'woff2', 'ttf', 'map'];

        if (in_array($extension, $staticExtensions, true)) {
            return true;
        }

        return false;
    }

    /**
     * Resolve approximate country or region without third-party external calls.
     */
    protected function detectCountry(Request $request): string
    {
        // Check Cloudflare or reverse proxy headers if available
        if ($cfCountry = $request->header('CF-IPCountry')) {
            return strtoupper($cfCountry);
        }

        if ($request->ip() === '127.0.0.1' || $request->ip() === '::1') {
            return 'Localhost / Internal';
        }

        return 'Global';
    }
}
