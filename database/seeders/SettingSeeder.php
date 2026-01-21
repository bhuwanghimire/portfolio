<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // General Settings
            [
                'key' => 'site_name',
                'value' => 'My Personal Website',
                'type' => 'string',
                'category' => 'general',
                'description' => 'Website name',
                'is_public' => true,
            ],
            [
                'key' => 'site_tagline',
                'value' => 'Welcome to my corner of the internet',
                'type' => 'string',
                'category' => 'general',
                'description' => 'Website tagline or subtitle',
                'is_public' => true,
            ],
            [
                'key' => 'site_description',
                'value' => 'Personal website and blog',
                'type' => 'string',
                'category' => 'general',
                'description' => 'Site description',
                'is_public' => true,
            ],
            [
                'key' => 'admin_email',
                'value' => 'admin@example.com',
                'type' => 'string',
                'category' => 'general',
                'description' => 'Administrator email',
                'is_public' => false,
            ],
            [
                'key' => 'timezone',
                'value' => 'UTC',
                'type' => 'string',
                'category' => 'general',
                'description' => 'Site timezone',
                'is_public' => false,
            ],
            [
                'key' => 'date_format',
                'value' => 'Y-m-d',
                'type' => 'string',
                'category' => 'general',
                'description' => 'Date display format',
                'is_public' => false,
            ],

            // Appearance Settings
            [
                'key' => 'theme',
                'value' => 'light',
                'type' => 'string',
                'category' => 'appearance',
                'description' => 'Color theme (light/dark/auto)',
                'is_public' => true,
            ],
            [
                'key' => 'primary_color',
                'value' => '#3B82F6',
                'type' => 'string',
                'category' => 'appearance',
                'description' => 'Primary brand color',
                'is_public' => true,
            ],
            [
                'key' => 'secondary_color',
                'value' => '#8B5CF6',
                'type' => 'string',
                'category' => 'appearance',
                'description' => 'Secondary brand color',
                'is_public' => true,
            ],
            [
                'key' => 'font_family',
                'value' => 'Inter, sans-serif',
                'type' => 'string',
                'category' => 'appearance',
                'description' => 'Main font family',
                'is_public' => true,
            ],
            [
                'key' => 'logo_url',
                'value' => '',
                'type' => 'string',
                'category' => 'appearance',
                'description' => 'Logo image URL',
                'is_public' => true,
            ],
            [
                'key' => 'favicon_url',
                'value' => '',
                'type' => 'string',
                'category' => 'appearance',
                'description' => 'Favicon URL',
                'is_public' => true,
            ],
            [
                'key' => 'posts_per_page',
                'value' => '10',
                'type' => 'number',
                'category' => 'appearance',
                'description' => 'Number of posts per page',
                'is_public' => false,
            ],

            // SEO Settings
            [
                'key' => 'meta_title',
                'value' => 'My Personal Website',
                'type' => 'string',
                'category' => 'seo',
                'description' => 'Default meta title',
                'is_public' => true,
            ],
            [
                'key' => 'meta_description',
                'value' => 'Personal website and blog showcasing my work and thoughts',
                'type' => 'string',
                'category' => 'seo',
                'description' => 'Default meta description',
                'is_public' => true,
            ],
            [
                'key' => 'meta_keywords',
                'value' => 'blog, portfolio, personal website',
                'type' => 'string',
                'category' => 'seo',
                'description' => 'Default meta keywords',
                'is_public' => true,
            ],
            [
                'key' => 'og_image',
                'value' => '',
                'type' => 'string',
                'category' => 'seo',
                'description' => 'Default Open Graph image URL',
                'is_public' => true,
            ],
            [
                'key' => 'google_analytics_id',
                'value' => '',
                'type' => 'string',
                'category' => 'seo',
                'description' => 'Google Analytics tracking ID',
                'is_public' => false,
            ],
            [
                'key' => 'google_search_console',
                'value' => '',
                'type' => 'string',
                'category' => 'seo',
                'description' => 'Google Search Console verification code',
                'is_public' => false,
            ],

            // Social Media
            [
                'key' => 'twitter_handle',
                'value' => '',
                'type' => 'string',
                'category' => 'social',
                'description' => 'Twitter/X username',
                'is_public' => true,
            ],
            [
                'key' => 'github_username',
                'value' => '',
                'type' => 'string',
                'category' => 'social',
                'description' => 'GitHub username',
                'is_public' => true,
            ],
            [
                'key' => 'linkedin_url',
                'value' => '',
                'type' => 'string',
                'category' => 'social',
                'description' => 'LinkedIn profile URL',
                'is_public' => true,
            ],
            [
                'key' => 'facebook_url',
                'value' => '',
                'type' => 'string',
                'category' => 'social',
                'description' => 'Facebook profile URL',
                'is_public' => true,
            ],
            [
                'key' => 'instagram_handle',
                'value' => '',
                'type' => 'string',
                'category' => 'social',
                'description' => 'Instagram username',
                'is_public' => true,
            ],
            [
                'key' => 'youtube_channel',
                'value' => '',
                'type' => 'string',
                'category' => 'social',
                'description' => 'YouTube channel URL',
                'is_public' => true,
            ],

            // Features
            [
                'key' => 'enable_comments',
                'value' => 'true',
                'type' => 'boolean',
                'category' => 'features',
                'description' => 'Enable comments on posts',
                'is_public' => false,
            ],
            [
                'key' => 'enable_newsletter',
                'value' => 'false',
                'type' => 'boolean',
                'category' => 'features',
                'description' => 'Enable newsletter signup',
                'is_public' => false,
            ],
            [
                'key' => 'enable_search',
                'value' => 'true',
                'type' => 'boolean',
                'category' => 'features',
                'description' => 'Enable site search',
                'is_public' => false,
            ],
            [
                'key' => 'enable_rss',
                'value' => 'true',
                'type' => 'boolean',
                'category' => 'features',
                'description' => 'Enable RSS feed',
                'is_public' => false,
            ],
            [
                'key' => 'maintenance_mode',
                'value' => 'false',
                'type' => 'boolean',
                'category' => 'features',
                'description' => 'Enable maintenance mode',
                'is_public' => false,
            ],

            // Contact Settings
            [
                'key' => 'contact_email',
                'value' => 'contact@example.com',
                'type' => 'string',
                'category' => 'contact',
                'description' => 'Contact form email recipient',
                'is_public' => true,
            ],
            [
                'key' => 'phone_number',
                'value' => '',
                'type' => 'string',
                'category' => 'contact',
                'description' => 'Contact phone number',
                'is_public' => true,
            ],
            [
                'key' => 'address',
                'value' => '',
                'type' => 'string',
                'category' => 'contact',
                'description' => 'Physical address',
                'is_public' => true,
            ],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']], // Match condition
                $setting // Data to update or create
            );
        }

        $this->command->info('Settings seeded successfully!');
    }
}
