<?php

namespace Tests\Feature;

use SimpleXMLElement;
use Tests\TestCase;

class InfrastructureAndCrawlingTest extends TestCase
{
    /**
     * Complete inventory of all 22 public indexable URLs as defined in sitemap.xml.
     *
     * @var array<int, string>
     */
    protected array $expectedPublicUrls = [
        'https://famewoven.com',
        'https://famewoven.com/services',
        'https://famewoven.com/services/sponsored-x-posts',
        'https://famewoven.com/services/x-threads',
        'https://famewoven.com/services/quote-reposts',
        'https://famewoven.com/services/organic-amplification',
        'https://famewoven.com/services/launch-campaigns',
        'https://famewoven.com/services/product-promotion',
        'https://famewoven.com/services/multi-creator-campaigns',
        'https://famewoven.com/services/founder-ceo-campaigns',
        'https://famewoven.com/services/trend-narrative-campaigns',
        'https://famewoven.com/services/performance-campaigns',
        'https://famewoven.com/services/creator-seeding',
        'https://famewoven.com/services/influencer-outreach',
        'https://famewoven.com/services/long-term-creator-partnerships',
        'https://famewoven.com/services/custom-x-campaigns',
        'https://famewoven.com/creators',
        'https://famewoven.com/work',
        'https://famewoven.com/work/case-study',
        'https://famewoven.com/about',
        'https://famewoven.com/insights',
        'https://famewoven.com/contact',
    ];

    /**
     * Tier 1 & 2: Assert /robots.txt returns 200 text/plain, contains User-agent: *, Allow: /,
     * Disallow: /admin, Host, and Sitemap directive.
     */
    public function test_robots_txt_contains_proper_directives_and_sitemap(): void
    {
        $response = $this->get('/robots.txt');

        $response->assertStatus(200);
        $this->assertStringContainsString('text/plain', $response->headers->get('Content-Type') ?? '');

        $content = $response->getContent();

        $this->assertStringContainsString('User-agent: *', $content, 'robots.txt must specify User-agent: *');
        $this->assertStringContainsString('Allow: /', $content, 'robots.txt must allow public root crawling');
        $this->assertMatchesRegularExpression(
            '/Disallow:\s*\/admin/i',
            $content,
            'robots.txt must protect administrative paths with Disallow: /admin'
        );
        $this->assertStringContainsString(
            'Sitemap: https://famewoven.com/sitemap.xml',
            $content,
            'robots.txt must declare Sitemap directive pointing to https://famewoven.com/sitemap.xml'
        );
    }

    /**
     * Tier 1 & 3: Assert /sitemap.xml returns 200 with XML content-type, is well-formed XML,
     * contains all 22 public URLs in <loc>, and every listed URL returns HTTP 200.
     */
    public function test_sitemap_xml_is_valid_and_lists_all_indexable_public_urls(): void
    {
        $response = $this->get('/sitemap.xml');

        $response->assertStatus(200);
        $this->assertMatchesRegularExpression(
            '/(application|text)\/xml/i',
            $response->headers->get('Content-Type') ?? '',
            'sitemap.xml must return an XML content type header.'
        );

        $xmlContent = $response->getContent();
        $this->assertNotEmpty($xmlContent, 'sitemap.xml content is empty.');

        libxml_use_internal_errors(true);
        $xml = simplexml_load_string($xmlContent);
        $xmlErrors = libxml_get_errors();
        libxml_clear_errors();

        $this->assertInstanceOf(
            SimpleXMLElement::class,
            $xml,
            'sitemap.xml could not be parsed as valid XML: ' . json_encode($xmlErrors)
        );

        $this->assertGreaterThanOrEqual(
            22,
            count($xml->url),
            'sitemap.xml must contain at least 22 public <url> entries.'
        );

        $extractedUrls = [];
        foreach ($xml->url as $urlEntry) {
            $loc = (string) $urlEntry->loc;
            $this->assertNotEmpty($loc, 'Found empty <loc> entry in sitemap.xml.');

            // Verify standard XML sitemap metadata tags
            $this->assertNotEmpty((string) $urlEntry->lastmod, "Missing <lastmod> for {$loc}");
            $this->assertNotEmpty((string) $urlEntry->changefreq, "Missing <changefreq> for {$loc}");
            $this->assertNotEmpty((string) $urlEntry->priority, "Missing <priority> for {$loc}");

            $extractedUrls[] = rtrim($loc, '/');
        }

        // Verify all 22 expected public URLs are listed in sitemap
        foreach ($this->expectedPublicUrls as $expectedUrl) {
            $normalizedExpected = rtrim($expectedUrl, '/');
            $this->assertContains(
                $normalizedExpected,
                $extractedUrls,
                "Expected public URL '{$expectedUrl}' was not found in sitemap.xml <loc> entries."
            );
        }

        // Crawl and verify HTTP 200 reachability for every <loc> listed in sitemap
        foreach ($xml->url as $urlEntry) {
            $loc = (string) $urlEntry->loc;
            $path = parse_url($loc, PHP_URL_PATH) ?? '/';

            $pageResponse = $this->get($path);
            $this->assertSame(
                200,
                $pageResponse->getStatusCode(),
                "Sitemap entry '{$loc}' (path '{$path}') returned HTTP {$pageResponse->getStatusCode()} instead of 200."
            );
        }
    }

    /**
     * Tier 2: Assert Google Search Console verification meta tag renders if and only if
     * a verification token is configured in services.google.site_verification.
     */
    public function test_google_search_console_meta_tag_renders_when_configured(): void
    {
        // Scenario A: Configured Token
        config(['services.google.site_verification' => 'test-gsc-token-famewoven-12345']);

        $response = $this->get('/');
        $response->assertStatus(200);

        $html = $response->getContent();
        $this->assertMatchesRegularExpression(
            '/<meta\b(?=[^>]*\bname=["\']google-site-verification["\'])(?=[^>]*\bcontent=["\']test-gsc-token-famewoven-12345["\'])[^>]*>/i',
            $html,
            'Google Search Console meta tag not found when services.google.site_verification is set.'
        );

        // Scenario B: Null / Unconfigured Token
        config(['services.google.site_verification' => null]);

        $responseUnset = $this->get('/');
        $responseUnset->assertStatus(200);

        $this->assertStringNotContainsString(
            'google-site-verification',
            $responseUnset->getContent(),
            'Google Search Console meta tag should not render when token is null.'
        );
    }

    /**
     * Tier 2 & 4: Assert HTTPS enforcement redirects insecure HTTP requests to HTTPS with 301
     * and sets Strict-Transport-Security header on secure requests when app.force_https is enabled.
     */
    public function test_https_enforcement_redirects_insecure_requests_when_enabled(): void
    {
        config(['app.force_https' => true]);

        // Insecure request to root
        $insecureResponse = $this->get('/');
        $this->assertSame(
            301,
            $insecureResponse->getStatusCode(),
            'Insecure request did not return 301 redirect when app.force_https is enabled.'
        );

        $location = $insecureResponse->headers->get('Location') ?? '';
        $this->assertStringStartsWith(
            'https://',
            $location,
            "Expected 301 redirect Location header to start with 'https://', got '{$location}'."
        );

        // Secure request (simulated with HTTPS=on)
        $secureResponse = $this->call('GET', 'https://famewoven.com/', [], [], [], [
            'HTTPS' => 'on',
        ]);

        $this->assertSame(200, $secureResponse->getStatusCode());
        $hstsHeader = $secureResponse->headers->get('Strict-Transport-Security');
        $this->assertNotNull(
            $hstsHeader,
            'Strict-Transport-Security header was not set on secure request with force_https enabled.'
        );
        $this->assertStringContainsString('max-age=31536000', $hstsHeader);
    }

    /**
     * Tier 2: Assert HTTPS enforcement does NOT break testing environment by default
     * (config('app.force_https') is false by default in testing).
     */
    public function test_https_enforcement_does_not_break_testing_environment_by_default(): void
    {
        // Assert testing default configuration
        $this->assertFalse(
            (bool) config('app.force_https', false),
            'app.force_https should default to false in the testing environment.'
        );

        // Standard test GET request must succeed with 200 without redirect
        $response = $this->get('/');
        $response->assertStatus(200);

        $aboutResponse = $this->get('/about');
        $aboutResponse->assertStatus(200);
    }

    /**
     * Tier 4: Full Crawler Emulation Scenario
     * Simulates Googlebot inspecting robots.txt, discovering sitemap.xml,
     * and crawling all public pages to verify indexing rules.
     */
    public function test_full_crawler_emulation_scenario(): void
    {
        // 1. Crawler fetches robots.txt
        $robotsResponse = $this->get('/robots.txt');
        $robotsResponse->assertStatus(200);
        $robotsBody = $robotsResponse->getContent();

        // 2. Crawler extracts sitemap reference
        $hasSitemapDirective = preg_match('/^Sitemap:\s*(.+)$/im', $robotsBody, $matches);
        $this->assertSame(1, $hasSitemapDirective, 'Crawler failed to find Sitemap directive in robots.txt.');
        $sitemapUrl = trim($matches[1]);
        $sitemapPath = parse_url($sitemapUrl, PHP_URL_PATH);

        // 3. Crawler fetches and parses sitemap.xml
        $sitemapResponse = $this->get($sitemapPath);
        $sitemapResponse->assertStatus(200);
        $xml = simplexml_load_string($sitemapResponse->getContent());
        $this->assertInstanceOf(SimpleXMLElement::class, $xml);

        // 4. Crawler accesses each public URL and asserts indexing metadata
        foreach ($xml->url as $urlElement) {
            $pagePath = parse_url((string) $urlElement->loc, PHP_URL_PATH) ?? '/';
            $page = $this->get($pagePath);

            $this->assertSame(200, $page->getStatusCode(), "Crawler encountered non-200 on {$pagePath}");

            // Verify crawler indexability (meta robots contains index, follow and not noindex)
            $pageHtml = $page->getContent();
            preg_match('/<meta\b(?=[^>]*\bname=["\']robots["\'])(?=[^>]*\bcontent=["\']([^"\']*)["\'])[^>]*>/is', $pageHtml, $robotsMeta);

            if (!empty($robotsMeta[1])) {
                $this->assertStringContainsString('index', $robotsMeta[1], "Page {$pagePath} should allow indexing.");
                $this->assertStringNotContainsString('noindex', $robotsMeta[1], "Public page {$pagePath} should not have noindex directive.");
            }
        }
    }
}
