<?php

use App\Models\Profile;
use Livewire\Component;

new class extends Component {
    public ?Profile $about = null;

    public function mount() : void
    {
        $this->about = Profile::select('about_me', 'name', 'email', 'phone', 'location', 'availability_status')->first();
    }
};
?>
@placeholder
<div></div>
@endplaceholder
<section id="about" class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">About Me</h2>
            <div class="w-16 h-1 bg-primary mx-auto rounded"></div>
        </div>

        <div class="bg-white p-8 md:p-12 rounded-3xl shadow-sm border border-gray-100">
            <p class="text-lg text-gray-600 leading-8 mb-8 text-center max-w-3xl mx-auto">
                {{@$about->about_me}}
            </p>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 text-center">
                <div class="p-4">
                    <span class="block text-sm text-gray-400 uppercase tracking-wider mb-2">Name</span>
                    <span class="font-semibold text-gray-900 text-lg">{{@$about->name}}</span>
                </div>
                <div class="p-4">
                    <span class="block text-sm text-gray-400 uppercase tracking-wider mb-2">Email</span>
                    <span class="font-semibold text-gray-900 text-lg">{{@$about->email}}</span>
                </div>
                <div class="p-4">
                    <span class="block text-sm text-gray-400 uppercase tracking-wider mb-2">Location</span>
                    <span class="font-semibold text-gray-900 text-lg">{{@$about->location}}</span>
                </div>
                <div class="p-4">
                    <span
                        class="block text-sm text-gray-400 uppercase tracking-wider mb-2">{{@$about->availability_status}}</span>
                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            Open to work
                        </span>
                </div>
            </div>
        </div>
    </div>
</section>
