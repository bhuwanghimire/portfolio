<?php

use App\Traits\WithToastr;
use Livewire\Component;
use App\Models\Profile;
use Livewire\WithFileUploads;

new class extends Component {
    use WithToastr, WithFileUploads;

    public $activeTab = 'personal';

    // Personal Info
    public $name = '';
    public $email = '';
    public $phone = '';
    public $location = '';
    public $title = '';
    public $bio = '';
    public $date_of_birth = '';
    public $avatar;
    public $current_avatar = '';

    // Availability
    public $availability_status = 'open';

    // Social Links
    public $website = '';
    public $github = '';
    public $linkedin = '';
    public $twitter = '';

    // About Me
    public $about_me = '';
    public $headline = '';
    public $years_experience = 0;
    public $completed_projects = 0;
    public $happy_clients = 0;
    public $about_me_sub_heading = '';

    // Resume
    public $resume_url = '';

    public function mount()
    {
        $this->loadProfile();
    }

    public function loadProfile()
    {
        $profile = Profile::first();

        if ($profile) {
            $this->name = $profile->name;
            $this->email = $profile->email;
            $this->phone = $profile->phone ?? '';
            $this->location = $profile->location;
            $this->title = $profile->title ?? '';
            $this->bio = $profile->bio;
            $this->date_of_birth = $profile->date_of_birth ? $profile->date_of_birth->format('Y-m-d') : '';
            $this->current_avatar = $profile->avatar ?? '';
            $this->availability_status = $profile->availability_status;
            $this->website = $profile->website ?? '';
            $this->github = $profile->github ?? '';
            $this->linkedin = $profile->linkedin ?? '';
            $this->twitter = $profile->twitter ?? '';
            // $this->resume_url = $profile->resume_url ?? '';
            $this->about_me = $profile->about_me ?? '';
            $this->headline = $profile->headline ?? '';
            $this->years_experience = $profile->years_experience ?? 0;
            $this->completed_projects = $profile->completed_projects ?? 0;
            $this->happy_clients = $profile->happy_clients ?? 0;
            $this->about_me_sub_heading = $profile->about_me_sub_heading ?? '';
        }
    }

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'location' => 'required|string|max:255',
            'bio' => 'required|string',
            'avatar' => 'nullable|image|max:2048',
        ]);

        $profile = Profile::first();

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'location' => $this->location,
            'title' => $this->title,
            'bio' => $this->bio,
            'date_of_birth' => $this->date_of_birth ?: null,
            'availability_status' => $this->availability_status,
            'website' => $this->website,
            'github' => $this->github,
            'linkedin' => $this->linkedin,
            'twitter' => $this->twitter,
            'about_me' => $this->about_me,
            'headline' => $this->headline,
            'years_experience' => $this->years_experience,
            'completed_projects' => $this->completed_projects,
            'happy_clients' => $this->happy_clients,
            'about_me_sub_heading' => $this->about_me_sub_heading,
        ];

        // Handle avatar upload
        if ($this->avatar) {
            $path = $this->avatar->store('avatars', 'public');
            $data['avatar'] = '/storage/' . $path;
        }

        if ($this->resume_url) {
            $resumePath = $this->resume_url->store('resumes', 'public');
            $data['resume_url'] = '/storage/' . $resumePath;
        }

        if ($profile) {
            $profile->update($data);
        } else {
            Profile::create($data);
        }

        $this->toastSuccess('Profile updated successfully!');
        $this->loadProfile();
    }
}; ?>

<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Profile Settings</h1>
            <p class="mt-2 text-sm text-gray-600">Manage your personal information and professional profile</p>
        </div>

        <div class="flex flex-col lg:flex-row gap-6">

            <!-- Sidebar Navigation -->
            <div class="lg:w-64 flex-shrink-0">
                <div class="bg-white rounded-lg shadow-sm p-4">
                    <nav class="space-y-1">
                        <button wire:click="setActiveTab('personal')"
                            class="w-full flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ $activeTab === 'personal' ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50' }}">
                            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Personal Info
                        </button>

                        <button wire:click="setActiveTab('professional')"
                            class="w-full flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ $activeTab === 'professional' ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50' }}">
                            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            Professional
                        </button>

                        <button wire:click="setActiveTab('social')"
                            class="w-full flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ $activeTab === 'social' ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50' }}">
                            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                            </svg>
                            Social Links
                        </button>
                    </nav>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="flex-1">
                <div class="bg-white rounded-lg shadow-sm">
                    <form wire:submit.prevent="save">
                        <div class="p-6 space-y-6">

                            <!-- Personal Info Tab -->
                            @if ($activeTab === 'personal')
                                <div>
                                    <h2 class="text-xl font-semibold text-gray-900 mb-6">Personal Information</h2>

                                    <div class="space-y-6">
                                        <!-- Avatar Upload -->
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Profile
                                                Picture</label>
                                            <div class="flex items-center gap-4">

                                                @if ($avatar)
                                                    <img src="{{ $avatar->temporaryUrl() }}" alt="Avatar"
                                                        class="w-20 h-20 rounded-full object-cover">
                                                @elseif ($current_avatar)
                                                    <img src="{{ asset($current_avatar) }}" alt="Avatar"
                                                        class="w-20 h-20 rounded-full object-cover">
                                                @else
                                                    <div
                                                        class="w-20 h-20 rounded-full bg-gray-200 flex items-center justify-center">
                                                        <svg class="w-10 h-10 text-gray-400" fill="currentColor"
                                                            viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd"
                                                                d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    </div>
                                                @endif
                                                <input type="file" wire:model="avatar" accept="image/*"
                                                    class="block text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                            </div>
                                            @error('avatar')
                                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Full Name <span
                                                    class="text-red-500">*</span></label>
                                            <input type="text" wire:model="name"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                            @error('name')
                                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2">Email <span
                                                        class="text-red-500">*</span></label>
                                                <input type="email" wire:model="email"
                                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                                @error('email')
                                                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div>
                                                <label
                                                    class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                                                <input type="text" wire:model="phone"
                                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                            </div>
                                        </div>

                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2">Location
                                                    <span class="text-red-500">*</span></label>
                                                <input type="text" wire:model="location"
                                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                                @error('location')
                                                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2">Date of
                                                    Birth</label>
                                                <input type="date" wire:model="date_of_birth"
                                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Professional Tab -->
                            @if ($activeTab === 'professional')
                                <div>
                                    <h2 class="text-xl font-semibold text-gray-900 mb-6">Professional Information</h2>

                                    <div class="space-y-6">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Professional
                                                Title</label>
                                            <input type="text" wire:model="title"
                                                placeholder="e.g., UI/UX Designer & Frontend Developer"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Bio Short <span
                                                    class="text-red-500">*</span></label>
                                            <textarea wire:model="bio" rows="6"
                                                placeholder="Tell us about yourself, your experience, and what you're passionate about..."
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                                            @error('bio')
                                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">About Me <span
                                                    class="text-red-500">*</span></label>
                                            <textarea wire:model="about_me" rows="6" placeholder="About me."
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                                            @error('bio')
                                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2">About Me
                                                    Sub Heading</label>
                                                <input type="text" wire:model="about_me_sub_heading"
                                                    rows="6" placeholder="About me."
                                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                            </div>
                                        </div>



                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Availability
                                                Status</label>
                                            <select wire:model="availability_status"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                                <option value="open">Open to work</option>
                                                <option value="busy">Busy</option>
                                                <option value="closed">Not available</option>
                                            </select>
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Resume/CV
                                                URL</label>
                                            <input type="file" wire:model="resume_url"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        </div>
                                        <div>
                                            <label
                                                class="block text-sm font-medium text-gray-700 mb-2">Headline</label>
                                            <input type="text" wire:model="headline"
                                                placeholder="Welcome to my world"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        </div>

                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2">Years
                                                    Experience</label>
                                                <div class="relative">
                                                    <input type="number" wire:model="years_experience"
                                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                                    <div
                                                        class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                                        <span class="text-gray-500 sm:text-sm">+</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2">Projects
                                                    Completed</label>
                                                <div class="relative">
                                                    <input type="number" wire:model="completed_projects"
                                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                                    <div
                                                        class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                                        <span class="text-gray-500 sm:text-sm">+</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-2">Happy
                                                    Clients</label>
                                                <div class="relative">
                                                    <input type="number" wire:model="happy_clients"
                                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                                    <div
                                                        class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                                        <span class="text-gray-500 sm:text-sm">+</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Social Links Tab -->
                            @if ($activeTab === 'social')
                                <div>
                                    <h2 class="text-xl font-semibold text-gray-900 mb-6">Social Media Links</h2>

                                    <div class="space-y-6">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                <span class="flex items-center gap-2">
                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                        <path
                                                            d="M10 12a2 2 0 100-4 2 2 0 000 4z M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" />
                                                    </svg>
                                                    Website
                                                </span>
                                            </label>
                                            <input type="text" wire:model="website"
                                                placeholder="https://yoursite.com"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                <span class="flex items-center gap-2">
                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                        <path
                                                            d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" />
                                                    </svg>
                                                    GitHub Username
                                                </span>
                                            </label>
                                            <input type="text" wire:model="github" placeholder="username"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                <span class="flex items-center gap-2">
                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                        <path
                                                            d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                                                    </svg>
                                                    LinkedIn URL
                                                </span>
                                            </label>
                                            <input type="text" wire:model="linkedin"
                                                placeholder="https://linkedin.com/in/username"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                <span class="flex items-center gap-2">
                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                        <path
                                                            d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                                                    </svg>
                                                    Twitter Handle
                                                </span>
                                            </label>
                                            <input type="text" wire:model="twitter" placeholder="@username"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>

                        <!-- Footer with Save Button -->
                        <div
                            class="sticky bottom-0 px-6 py-4 bg-white border-t border-gray-200 rounded-b-lg flex justify-between items-center shadow-lg">
                            <p class="text-sm text-gray-600">Make sure to save your changes</p>
                            <button type="submit"
                                class="px-8 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors shadow-md">
                                💾 Save Profile
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
