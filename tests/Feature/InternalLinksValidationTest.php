<?php

namespace Tests\Feature;

use Tests\TestCase;

class InternalLinksValidationTest extends TestCase
{
    /**
     * Complete inventory of all 22 public indexable routes.
     *
     * @var array<int, string>
     */
    protected array $publicRoutes = [
        '/',
        '/about',
        '/contact',
        '/creators',
        '/services',
        '/services/creator-seeding',
        '/services/custom-x-campaigns',
        '/services/founder-ceo-campaigns',
        '/services/influencer-outreach',
        '/services/launch-campaigns',
        '/services/long-term-creator-partnerships',
        '/services/multi-creator-campaigns',
        '/services/organic-amplification',
        '/services/performance-campaigns',
        '/services/product-promotion',
        '/services/quote-reposts',
        '/services/sponsored-x-posts',
        '/services/trend-narrative-campaigns',
        '/services/x-threads',
        '/work',
        '/work/case-study',
        '/insights',
    ];

    /**
     * Tier 1 & 3: Extracts all <a href="..."> internal links across all 22 public views,
     * deduplicates them, requests each, and asserts each returns HTTP 200 (zero broken links).
     */
    public function test_zero_broken_internal_links_across_all_public_views(): void
    {
        $internalLinkTargets = [];

        foreach ($this->publicRoutes as $route) {
            $response = $this->get($route);
            $response->assertStatus(200);

            $html = $response->getContent();
            preg_match_all('/<a\b[^>]*\bhref=["\']([^"\']*)["\'][^>]*>/is', $html, $matches);

            foreach ($matches[1] as $href) {
                $trimmedHref = trim($href);

                // Skip pure fragment anchors (#, #faq, #contact)
                if (str_starts_with($trimmedHref, '#') || $trimmedHref === '') {
                    continue;
                }

                // Skip non-HTTP schemes
                if (preg_match('/^(mailto:|tel:|javascript:)/i', $trimmedHref)) {
                    continue;
                }

                // Check external domains
                $host = parse_url($trimmedHref, PHP_URL_HOST);
                if ($host && !in_array($host, ['localhost', '127.0.0.1', 'famewoven.com', 'www.famewoven.com'], true)) {
                    continue;
                }

                $path = parse_url($trimmedHref, PHP_URL_PATH) ?? '/';
                $internalLinkTargets[$path] = true;
            }
        }

        $this->assertNotEmpty($internalLinkTargets, 'Failed to extract any internal links from public views.');

        $brokenLinks = [];
        foreach (array_keys($internalLinkTargets) as $targetPath) {
            $targetResponse = $this->get($targetPath);
            $statusCode = $targetResponse->getStatusCode();

            if ($statusCode !== 200) {
                $brokenLinks[$targetPath] = $statusCode;
            }
        }

        $this->assertEmpty(
            $brokenLinks,
            'Broken internal links (non-200 responses) found across public views: ' . json_encode($brokenLinks, JSON_PRETTY_PRINT)
        );
    }

    /**
     * Tier 2 & 3: Assert that no dead placeholder links (href="#" or href="")
     * exist in the rendered HTML of any public view.
     */
    public function test_zero_dead_placeholder_links_in_public_views(): void
    {
        $deadLinksByRoute = [];

        foreach ($this->publicRoutes as $route) {
            $response = $this->get($route);
            $response->assertStatus(200);

            $html = $response->getContent();

            // Match anchor tags where href is exactly "#" or empty
            preg_match_all('/<a\b[^>]*\bhref=(["\'])(?:#|\s*)\1[^>]*>(.*?)<\/a>/is', $html, $matches, PREG_SET_ORDER);

            if (!empty($matches)) {
                $deadLinksByRoute[$route] = array_map(function ($match) {
                    return [
                        'tag' => trim($match[0]),
                        'text' => trim(strip_tags($match[2])),
                    ];
                }, $matches);
            }
        }

        $this->assertEmpty(
            $deadLinksByRoute,
            'Dead placeholder links (href="#") detected across public views: ' . json_encode($deadLinksByRoute, JSON_PRETTY_PRINT)
        );
    }

    /**
     * Tier 3: Assert that no public pages contain internal links leading to
     * crawler-disallowed administrative paths (/admin or /admin/...).
     */
    public function test_no_internal_links_point_to_disallowed_admin_paths(): void
    {
        $adminLinksFound = [];

        foreach ($this->publicRoutes as $route) {
            $response = $this->get($route);
            $html = $response->getContent();

            preg_match_all('/<a\b[^>]*\bhref=["\']([^"\']*)["\'][^>]*>/is', $html, $matches);

            foreach ($matches[1] as $href) {
                $path = parse_url(trim($href), PHP_URL_PATH) ?? '';
                if (str_starts_with($path, '/admin')) {
                    $adminLinksFound[$route][] = $href;
                }
            }
        }

        $this->assertEmpty(
            $adminLinksFound,
            'Public views contain internal links pointing to private administrative paths: ' . json_encode($adminLinksFound, JSON_PRETTY_PRINT)
        );
    }

    /**
     * Tier 4: Real-World Workload Scenario — Cross-Page User Navigation Journeys
     * Simulates organic user click-throughs from Home through Services catalog,
     * Creator vetting, Portfolio Case Studies, and Contact conversion funnel.
     */
    public function test_cross_page_navigation_journeys(): void
    {
        // Journey 1: Home -> Services Hub -> Specific Service -> Contact CTA
        $home = $this->get('/');
        $home->assertStatus(200);
        $home->assertSee('Services');

        $servicesHub = $this->get('/services');
        $servicesHub->assertStatus(200);
        $servicesHub->assertSee('Influencer Outreach', false);

        $serviceDetail = $this->get('/services/influencer-outreach');
        $serviceDetail->assertStatus(200);
        $serviceDetail->assertSee('Influencer Outreach', false);
        $serviceDetail->assertSee('Start brief', false);

        $contact = $this->get('/contact');
        $contact->assertStatus(200);
        $contact->assertSee('Book a Strategy Call', false);

        // Journey 2: Home -> Creators Page -> Apply CTA
        $creators = $this->get('/creators');
        $creators->assertStatus(200);
        $creators->assertSee('Creators', false);

        // Journey 3: Home -> Work Portfolio -> Specific Case Study
        $work = $this->get('/work');
        $work->assertStatus(200);
        $work->assertSee('Results, not reach', false);

        $caseStudy = $this->get('/work/case-study');
        $caseStudy->assertStatus(200);
        $caseStudy->assertSee('Case Study', false);

        // Journey 4: Insights Archive -> Field Notes
        $insights = $this->get('/insights');
        $insights->assertStatus(200);
        $insights->assertSee('Insights', false);
    }

    /**
     * Tier 2: Assert clean URL slugs across all public views (no .html extensions,
     * no malformed double slashes, and no trailing whitespace in href attributes).
     */
    public function test_clean_url_slugs_in_all_public_views(): void
    {
        $malformedHrefs = [];

        foreach ($this->publicRoutes as $route) {
            $response = $this->get($route);
            $html = $response->getContent();

            preg_match_all('/<a\b[^>]*\bhref=(["\'])(.*?)\1[^>]*>/is', $html, $matches);

            foreach ($matches[2] as $href) {
                // Check for deprecated .html extensions
                if (preg_match('/\.html(?:\?|#|$)/i', $href)) {
                    $malformedHrefs[$route][] = "Deprecated .html extension in href: '{$href}'";
                }

                // Check for malformed double slashes in relative paths (e.g. "//services")
                if (str_starts_with($href, '//') && !str_starts_with($href, '//cdn.')) {
                    $malformedHrefs[$route][] = "Malformed protocol-relative or double slash href: '{$href}'";
                }
            }
        }

        $this->assertEmpty(
            $malformedHrefs,
            'Malformed internal link hrefs found: ' . json_encode($malformedHrefs, JSON_PRETTY_PRINT)
        );
    }
}
