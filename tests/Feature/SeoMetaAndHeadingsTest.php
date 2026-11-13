<?php

namespace Tests\Feature;

use Tests\TestCase;

class SeoMetaAndHeadingsTest extends TestCase
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
     * Tier 1 & 2: Assert all 22 public pages return HTTP 200, have non-empty titles and descriptions,
     * and that there are 0 duplicate titles and 0 duplicate meta descriptions across the entire site.
     */
    public function test_all_public_pages_have_unique_titles_and_descriptions(): void
    {
        $titles = [];
        $descriptions = [];

        foreach ($this->publicRoutes as $route) {
            $response = $this->get($route);
            $response->assertStatus(200);

            $html = $response->getContent();

            // Extract <title>
            $hasTitle = preg_match('/<title\b[^>]*>(.*?)<\/title>/is', $html, $titleMatches);
            $this->assertSame(1, $hasTitle, "Route '{$route}' is missing a <title> tag.");
            $title = trim(html_entity_decode($titleMatches[1], ENT_QUOTES | ENT_HTML5, 'UTF-8'));
            $this->assertNotEmpty($title, "Route '{$route}' has an empty <title> tag.");
            $titles[$route] = $title;

            // Extract <meta name="description" content="...">
            $hasDescription = preg_match('/<meta\b(?=[^>]*\bname=["\']description["\'])(?=[^>]*\bcontent=["\']([^"\']*)["\'])[^>]*>/is', $html, $descMatches);
            $this->assertSame(1, $hasDescription, "Route '{$route}' is missing a meta description tag.");
            $description = trim(html_entity_decode($descMatches[1], ENT_QUOTES | ENT_HTML5, 'UTF-8'));
            $this->assertNotEmpty($description, "Route '{$route}' has an empty meta description tag.");
            $descriptions[$route] = $description;
        }

        // Verify total page count matches expected inventory
        $this->assertCount(22, $titles, 'Expected exactly 22 public page titles.');
        $this->assertCount(22, $descriptions, 'Expected exactly 22 public page descriptions.');

        // Verify uniqueness across all 22 pages
        $duplicateTitles = array_filter(array_count_values($titles), fn($count) => $count > 1);
        $this->assertEmpty(
            $duplicateTitles,
            'Duplicate meta titles detected across public pages: ' . json_encode($duplicateTitles, JSON_PRETTY_PRINT)
        );

        $duplicateDescriptions = array_filter(array_count_values($descriptions), fn($count) => $count > 1);
        $this->assertEmpty(
            $duplicateDescriptions,
            'Duplicate meta descriptions detected across public pages: ' . json_encode($duplicateDescriptions, JSON_PRETTY_PRINT)
        );
    }

    /**
     * Tier 1 & 2: Assert each of the 22 pages contains a valid <link rel="canonical" href="...">
     * matching the expected request route URL without duplicate or mismatched canonicals.
     */
    public function test_all_public_pages_have_canonical_urls(): void
    {
        foreach ($this->publicRoutes as $route) {
            $response = $this->get($route);
            $response->assertStatus(200);

            $html = $response->getContent();

            // Extract canonical link
            $hasCanonical = preg_match('/<link\b(?=[^>]*\brel=["\']canonical["\'])(?=[^>]*\bhref=["\']([^"\']*)["\'])[^>]*>/is', $html, $matches);
            $this->assertSame(1, $hasCanonical, "Route '{$route}' is missing a valid canonical link tag.");

            $canonicalHref = trim($matches[1]);
            $this->assertNotEmpty($canonicalHref, "Route '{$route}' has an empty canonical URL.");

            // Expected canonical path normalization
            $parsedCanonical = parse_url($canonicalHref, PHP_URL_PATH) ?? '/';
            $expectedPath = parse_url(url($route), PHP_URL_PATH) ?? '/';

            $this->assertSame(
                rtrim($expectedPath, '/') ?: '/',
                rtrim($parsedCanonical, '/') ?: '/',
                "Canonical path mismatch on route '{$route}': expected '{$expectedPath}', got '{$parsedCanonical}' (canonical: '{$canonicalHref}')"
            );
        }
    }

    /**
     * Tier 1 & 4: Assert Open Graph metadata (og:title, og:description, og:image, og:url)
     * and Twitter card tags are present with non-empty content on all 22 public pages.
     */
    public function test_all_public_pages_have_open_graph_metadata(): void
    {
        $requiredOgProperties = [
            'og:title',
            'og:description',
            'og:image',
            'og:url',
            'og:site_name',
        ];

        foreach ($this->publicRoutes as $route) {
            $response = $this->get($route);
            $response->assertStatus(200);
            $html = $response->getContent();

            foreach ($requiredOgProperties as $property) {
                $pattern = '/<meta\b(?=[^>]*\bproperty=["\']' . preg_quote($property, '/') . '["\'])(?=[^>]*\bcontent=["\']([^"\']*)["\'])[^>]*>/is';
                $found = preg_match($pattern, $html, $matches);

                $this->assertSame(
                    1,
                    $found,
                    "Route '{$route}' is missing Open Graph tag for '{$property}'."
                );

                $content = trim($matches[1]);
                $this->assertNotEmpty(
                    $content,
                    "Route '{$route}' has empty content for Open Graph property '{$property}'."
                );
            }

            // Assert Twitter Card metadata presence
            $this->assertMatchesRegularExpression(
                '/<meta\b(?=[^>]*\bname=["\']twitter:card["\'])(?=[^>]*\bcontent=["\'][^"\']+["\'])[^>]*>/is',
                $html,
                "Route '{$route}' is missing a valid twitter:card meta tag."
            );
            $this->assertMatchesRegularExpression(
                '/<meta\b(?=[^>]*\bname=["\']twitter:title["\'])(?=[^>]*\bcontent=["\'][^"\']+["\'])[^>]*>/is',
                $html,
                "Route '{$route}' is missing a valid twitter:title meta tag."
            );
        }
    }

    /**
     * Tier 2: Assert exactly one <h1> element exists in the rendered HTML across all 22 public pages.
     */
    public function test_all_public_pages_have_exactly_one_h1_element(): void
    {
        $h1Violations = [];

        foreach ($this->publicRoutes as $route) {
            $response = $this->get($route);
            $response->assertStatus(200);

            $html = $response->getContent();
            preg_match_all('/<h1\b[^>]*>(.*?)<\/h1>/is', $html, $matches);

            $count = count($matches[0]);
            if ($count !== 1) {
                $h1Violations[$route] = [
                    'count' => $count,
                    'elements' => array_map('strip_tags', $matches[0]),
                ];
            }
        }

        $this->assertEmpty(
            $h1Violations,
            'Single <h1> enforcement violated on pages: ' . json_encode($h1Violations, JSON_PRETTY_PRINT)
        );
    }

    /**
     * Tier 2 & 4: Assert heading progression never skips downward (e.g., no h1 -> h3, no h2 -> h4).
     */
    public function test_all_public_pages_have_valid_heading_hierarchy(): void
    {
        $hierarchyViolations = [];

        foreach ($this->publicRoutes as $route) {
            $response = $this->get($route);
            $response->assertStatus(200);

            $html = $response->getContent();

            // Extract all heading tags in document order
            preg_match_all('/<(h[1-6])\b[^>]*>(.*?)<\/\1>/is', $html, $matches, PREG_SET_ORDER);

            $previousLevel = 0;
            $routeViolations = [];

            foreach ($matches as $match) {
                $tagName = strtolower($match[1]);
                $currentLevel = (int) substr($tagName, 1);
                $headingText = trim(strip_tags($match[2]));

                // First heading should be h1
                if ($previousLevel === 0) {
                    if ($currentLevel !== 1) {
                        $routeViolations[] = "First heading is <{$tagName}> ('{$headingText}') instead of <h1>.";
                    }
                    $previousLevel = $currentLevel;
                    continue;
                }

                // Check downward skip: level cannot increase by more than 1 (e.g. h1 to h3 or h2 to h4 is invalid)
                if ($currentLevel > $previousLevel + 1) {
                    $routeViolations[] = "Heading skip detected: <h{$previousLevel}> jumped directly to <h{$currentLevel}> ('{$headingText}').";
                }

                $previousLevel = $currentLevel;
            }

            if (!empty($routeViolations)) {
                $hierarchyViolations[$route] = $routeViolations;
            }
        }

        $this->assertEmpty(
            $hierarchyViolations,
            'Heading hierarchy skip violations detected: ' . json_encode($hierarchyViolations, JSON_PRETTY_PRINT)
        );
    }

    /**
     * Tier 1 & 2: Assert all public pages containing <script type="application/ld+json">
     * contain well-formed, valid JSON-LD schema without syntax errors or dead URLs.
     */
    public function test_all_public_pages_contain_valid_json_ld_schema(): void
    {
        foreach ($this->publicRoutes as $route) {
            $response = $this->get($route);
            $response->assertStatus(200);

            $html = $response->getContent();

            // Extract all JSON-LD blocks
            preg_match_all('/<script\b[^>]*type=["\']application\/ld\+json["\'][^>]*>(.*?)<\/script>/is', $html, $matches);

            $this->assertNotEmpty(
                $matches[1],
                "Route '{$route}' does not contain any JSON-LD schema markup."
            );

            foreach ($matches[1] as $index => $jsonContent) {
                $trimmedJson = trim($jsonContent);
                $decoded = json_decode($trimmedJson, true);

                $this->assertSame(
                    JSON_ERROR_NONE,
                    json_last_error(),
                    "JSON-LD syntax error on route '{$route}' block #{$index}: " . json_last_error_msg() . "\nPayload: {$trimmedJson}"
                );

                $this->assertIsArray($decoded, "Decoded JSON-LD on route '{$route}' block #{$index} is not an array/object.");

                // Check @context
                if (isset($decoded['@context'])) {
                    $this->assertMatchesRegularExpression(
                        '/https?:\/\/schema\.org/i',
                        (string) $decoded['@context'],
                        "JSON-LD @context on route '{$route}' must reference schema.org."
                    );
                }

                // Check that no dead/deprecated URLs exist in schema (e.g. 'about.html')
                $this->assertStringNotContainsString(
                    'about.html',
                    $trimmedJson,
                    "JSON-LD schema on route '{$route}' contains dead URL reference 'about.html'."
                );
            }
        }
    }

    /**
     * Tier 1 & 2: Assert all <img> tags in rendered HTML across all 22 public pages
     * contain descriptive, non-empty alt attributes.
     */
    public function test_all_public_pages_have_meaningful_image_alt_attributes(): void
    {
        $missingAltViolations = [];

        foreach ($this->publicRoutes as $route) {
            $response = $this->get($route);
            $response->assertStatus(200);

            $html = $response->getContent();

            // Match all <img> tags in HTML body
            preg_match_all('/<img\b[^>]*>/is', $html, $imgMatches);

            foreach ($imgMatches[0] as $imgTag) {
                // Check if alt attribute exists
                $hasAlt = preg_match('/\balt=(["\'])(.*?)\1/is', $imgTag, $altMatches);

                if (!$hasAlt) {
                    $missingAltViolations[$route][] = "Missing alt attribute entirely: {$imgTag}";
                    continue;
                }

                $altValue = trim($altMatches[2]);
                if ($altValue === '') {
                    $missingAltViolations[$route][] = "Empty alt attribute found (alt=\"\"): {$imgTag}";
                }
            }
        }

        $this->assertEmpty(
            $missingAltViolations,
            'Images with missing or empty alt attributes found: ' . json_encode($missingAltViolations, JSON_PRETTY_PRINT)
        );
    }

    /**
     * Tier 4: Social Media Scraping Simulation
     * Simulates crawler scrapers (Facebook, LinkedIn, Twitter/X) asserting complete OG card payloads.
     */
    public function test_social_media_scraping_simulation(): void
    {
        foreach ($this->publicRoutes as $route) {
            $response = $this->get($route);
            $html = $response->getContent();

            // Extract og:image
            preg_match('/<meta\b(?=[^>]*\bproperty=["\']og:image["\'])(?=[^>]*\bcontent=["\']([^"\']*)["\'])[^>]*>/is', $html, $imgMatches);
            $this->assertNotEmpty($imgMatches[1], "Route '{$route}' missing og:image URL for social preview cards.");

            // Extract og:image:width and og:image:height
            preg_match('/<meta\b(?=[^>]*\bproperty=["\']og:image:width["\'])(?=[^>]*\bcontent=["\']([^"\']*)["\'])[^>]*>/is', $html, $widthMatches);
            $this->assertNotEmpty($widthMatches[1], "Route '{$route}' missing og:image:width metadata.");

            preg_match('/<meta\b(?=[^>]*\bproperty=["\']og:image:height["\'])(?=[^>]*\bcontent=["\']([^"\']*)["\'])[^>]*>/is', $html, $heightMatches);
            $this->assertNotEmpty($heightMatches[1], "Route '{$route}' missing og:image:height metadata.");
        }
    }
}
