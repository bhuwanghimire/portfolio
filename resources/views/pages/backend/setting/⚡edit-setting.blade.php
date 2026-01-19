<?php

use App\Traits\WithToastr;
use Livewire\Component;
use App\Models\Setting;

new class extends Component {
    use WithToastr;

    public $activeTab = 'general';

    // General Settings
    public $site_name = '';
    public $site_tagline = '';
    public $site_description = '';
    public $admin_email = '';
    public $timezone = '';

    // Appearance Settings
    public $theme = '';
    public $primary_color = '';
    public $logo_url = '';
    public $posts_per_page = '';

    // SEO Settings
    public $meta_title = '';
    public $meta_description = '';
    public $google_analytics_id = '';

    // Social Media
    public $twitter_handle = '';
    public $github_username = '';
    public $linkedin_url = '';

    // Features
    public $enable_comments = false;
    public $enable_newsletter = false;
    public $maintenance_mode = false;

    public function mount()
    {
        $this->loadSettings();
    }

    public function loadSettings()
    {
        $settings = Setting::all()->keyBy('key');

        // General
        $this->site_name = $settings['site_name']->value ?? '';
        $this->site_tagline = $settings['site_tagline']->value ?? '';
        $this->site_description = $settings['site_description']->value ?? '';
        $this->admin_email = $settings['admin_email']->value ?? '';
        $this->timezone = $settings['timezone']->value ?? '';

        // Appearance
        $this->theme = $settings['theme']->value ?? '';
        $this->primary_color = $settings['primary_color']->value ?? '';
        $this->logo_url = $settings['logo_url']->value ?? '';
        $this->posts_per_page = $settings['posts_per_page']->value ?? '';

        // SEO
        $this->meta_title = $settings['meta_title']->value ?? '';
        $this->meta_description = $settings['meta_description']->value ?? '';
        $this->google_analytics_id = $settings['google_analytics_id']->value ?? '';

        // Social
        $this->twitter_handle = $settings['twitter_handle']->value ?? '';
        $this->github_username = $settings['github_username']->value ?? '';
        $this->linkedin_url = $settings['linkedin_url']->value ?? '';

        // Features
        $this->enable_comments = ($settings['enable_comments']->value ?? 'false') === 'true';
        $this->enable_newsletter = ($settings['enable_newsletter']->value ?? 'false') === 'true';
        $this->maintenance_mode = ($settings['maintenance_mode']->value ?? 'false') === 'true';
    }

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function save()
    {
        $this->validate([
            'site_name' => 'required|string|max:255',
            'admin_email' => 'required|email',
            'posts_per_page' => 'required|integer|min:1|max:100',
        ]);

        $settingsData = [
            'site_name' => $this->site_name,
            'site_tagline' => $this->site_tagline,
            'site_description' => $this->site_description,
            'admin_email' => $this->admin_email,
            'timezone' => $this->timezone,
            'theme' => $this->theme,
            'primary_color' => $this->primary_color,
            'logo_url' => $this->logo_url,
            'posts_per_page' => $this->posts_per_page,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'google_analytics_id' => $this->google_analytics_id,
            'twitter_handle' => $this->twitter_handle,
            'github_username' => $this->github_username,
            'linkedin_url' => $this->linkedin_url,
            'enable_comments' => $this->enable_comments ? 'true' : 'false',
            'enable_newsletter' => $this->enable_newsletter ? 'true' : 'false',
            'maintenance_mode' => $this->maintenance_mode ? 'true' : 'false',
        ];

        foreach ($settingsData as $key => $value) {
            Setting::where('key', $key)->update(['value' => $value]);
        }
//        $this->toastSuccess('Settings saved successfully!');
        $this->toast('Settings saved!', 'success');

    }
};
?>

<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Website Settings</h1>
            <p class="mt-2 text-sm text-gray-600">Manage your website configuration and preferences</p>
        </div>


        <div class="flex flex-col lg:flex-row gap-6">

            <!-- Sidebar Navigation -->
            <div class="lg:w-64 flex-shrink-0">
                <div class="bg-white rounded-lg shadow-sm p-4">
                    <nav class="space-y-1">
                        <button
                            wire:click="setActiveTab('general')"
                            class="w-full flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ $activeTab === 'general' ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50' }}">
                            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            General
                        </button>

                        <button
                            wire:click="setActiveTab('appearance')"
                            class="w-full flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ $activeTab === 'appearance' ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50' }}">
                            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                            </svg>
                            Appearance
                        </button>

                        <button
                            wire:click="setActiveTab('seo')"
                            class="w-full flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ $activeTab === 'seo' ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50' }}">
                            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            SEO
                        </button>

                        <button
                            wire:click="setActiveTab('social')"
                            class="w-full flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ $activeTab === 'social' ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50' }}">
                            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            Social Media
                        </button>

                        <button
                            wire:click="setActiveTab('features')"
                            class="w-full flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ $activeTab === 'features' ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50' }}">
                            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"/>
                            </svg>
                            Features
                        </button>
                    </nav>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="flex-1">
                <div class="bg-white rounded-lg shadow-sm">
                    <form wire:submit.prevent="save">
                        <div class="p-6 space-y-6">

                            <!-- General Settings Tab -->
                            @if($activeTab === 'general')
                                <div>
                                    <h2 class="text-xl font-semibold text-gray-900 mb-6">General Settings</h2>

                                    <div class="space-y-6">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Site Name <span
                                                    class="text-red-500">*</span></label>
                                            <input type="text" wire:model="site_name"
                                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                            @error('site_name') <span
                                                class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Site
                                                Tagline</label>
                                            <input type="text" wire:model="site_tagline"
                                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Site
                                                Description</label>
                                            <textarea wire:model="site_description" rows="4"
                                                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Admin Email
                                                <span class="text-red-500">*</span></label>
                                            <input type="email" wire:model="admin_email"
                                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                            @error('admin_email') <span
                                                class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Timezone</label>
                                            <select wire:model="timezone"
                                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                                <option value="UTC">UTC</option>
                                                <option value="America/New_York">America/New_York</option>
                                                <option value="America/Los_Angeles">America/Los_Angeles</option>
                                                <option value="Europe/London">Europe/London</option>
                                                <option value="Asia/Tokyo">Asia/Tokyo</option>
                                                <option value="Asia/Kathmandu">Asia/Kathmandu</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Appearance Tab -->
                            @if($activeTab === 'appearance')
                                <div>
                                    <h2 class="text-xl font-semibold text-gray-900 mb-6">Appearance Settings</h2>

                                    <div class="space-y-6">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Theme</label>
                                            <select wire:model="theme"
                                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                                <option value="light">Light</option>
                                                <option value="dark">Dark</option>
                                                <option value="auto">Auto</option>
                                            </select>
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Primary
                                                Color</label>
                                            <div class="flex items-center gap-3">
                                                <input type="color" wire:model="primary_color"
                                                       class="h-12 w-20 border border-gray-300 rounded-lg cursor-pointer">
                                                <input type="text" wire:model="primary_color"
                                                       class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                            </div>
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Logo URL</label>
                                            <input type="text" wire:model="logo_url"
                                                   placeholder="https://example.com/logo.png"
                                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Posts Per Page
                                                <span class="text-red-500">*</span></label>
                                            <input type="number" wire:model="posts_per_page" min="1" max="100"
                                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                            @error('posts_per_page') <span
                                                class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- SEO Tab -->
                            @if($activeTab === 'seo')
                                <div>
                                    <h2 class="text-xl font-semibold text-gray-900 mb-6">SEO Settings</h2>

                                    <div class="space-y-6">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Meta
                                                Title</label>
                                            <input type="text" wire:model="meta_title"
                                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                            <p class="mt-1 text-sm text-gray-500">Recommended: 50-60 characters</p>
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Meta
                                                Description</label>
                                            <textarea wire:model="meta_description" rows="4"
                                                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                                            <p class="mt-1 text-sm text-gray-500">Recommended: 150-160 characters</p>
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Google Analytics
                                                ID</label>
                                            <input type="text" wire:model="google_analytics_id"
                                                   placeholder="G-XXXXXXXXXX"
                                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Social Media Tab -->
                            @if($activeTab === 'social')
                                <div>
                                    <h2 class="text-xl font-semibold text-gray-900 mb-6">Social Media Links</h2>

                                    <div class="space-y-6">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                <span class="flex items-center gap-2">
                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path
                                                            d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                                                    Twitter Handle
                                                </span>
                                            </label>
                                            <input type="text" wire:model="twitter_handle" placeholder="@username"
                                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                <span class="flex items-center gap-2">
                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path
                                                            d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                                                    GitHub Username
                                                </span>
                                            </label>
                                            <input type="text" wire:model="github_username" placeholder="username"
                                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                <span class="flex items-center gap-2">
                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path
                                                            d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                                                    LinkedIn URL
                                                </span>
                                            </label>
                                            <input type="text" wire:model="linkedin_url"
                                                   placeholder="https://linkedin.com/in/username"
                                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Features Tab -->
                            @if($activeTab === 'features')
                                <div>
                                    <h2 class="text-xl font-semibold text-gray-900 mb-6">Features & Options</h2>

                                    <div class="space-y-4">
                                        <div class="flex items-start p-4 bg-gray-50 rounded-lg">
                                            <div class="flex items-center h-5">
                                                <input type="checkbox" wire:model="enable_comments"
                                                       class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                            </div>
                                            <div class="ml-4">
                                                <label class="font-medium text-gray-900">Enable Comments</label>
                                                <p class="text-sm text-gray-500">Allow visitors to comment on your posts
                                                    and pages</p>
                                            </div>
                                        </div>

                                        <div class="flex items-start p-4 bg-gray-50 rounded-lg">
                                            <div class="flex items-center h-5">
                                                <input type="checkbox" wire:model="enable_newsletter"
                                                       class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                            </div>
                                            <div class="ml-4">
                                                <label class="font-medium text-gray-900">Enable Newsletter</label>
                                                <p class="text-sm text-gray-500">Show newsletter signup forms on your
                                                    website</p>
                                            </div>
                                        </div>

                                        <div class="flex items-start p-4 bg-red-50 rounded-lg border border-red-200">
                                            <div class="flex items-center h-5">
                                                <input type="checkbox" wire:model="maintenance_mode"
                                                       class="w-5 h-5 text-red-600 border-gray-300 rounded focus:ring-red-500">
                                            </div>
                                            <div class="ml-4">
                                                <label class="font-medium text-red-900">Maintenance Mode</label>
                                                <p class="text-sm text-red-700">Put your website in maintenance mode
                                                    (visitors will see a maintenance page)</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>

                        <!-- Footer with Save Button -->
                        <div
                            class="sticky bottom-0 px-6 py-4  border-t border-gray-200  rounded-b-lg flex justify-between items-center shadow-lg">
                            <p class="text-sm text-gray-600">Make sure to save your changes</p>
                            <button type="submit"
                                    class="px-8 py-3 bg-blue-500  font-semibold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors shadow-md">
                                💾 Save Settings
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


