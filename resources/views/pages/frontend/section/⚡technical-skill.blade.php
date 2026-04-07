<?php

use Livewire\Component;
use Illuminate\Database\Eloquent\Collection;

new class extends Component {
    public string $sectionName;
    public Collection $technicalSkills;

    public function boot(): void
    {
        $this->sectionName = 'technical-skill';
        $this->technicalSkills = \App\Models\TechnicalSkill::where('is_active', true)->orderBy('order')->get();
    }

    public function mount(): void {}
};
?>
@php
    $categories = [
        'Frontend' => [
            'icon' => '🎨',
            'bg_gradient' => 'from-indigo-50',
            'border_div' => 'border-indigo-100',
            'icon_bg' => 'bg-indigo-100',
            'badge_border' => 'border-indigo-100',
            'badge_text' => 'text-indigo-700',
        ],
        'Backend' => [
            'icon' => '⚙️',
            'bg_gradient' => 'from-cyan-50',
            'border_div' => 'border-cyan-100',
            'icon_bg' => 'bg-cyan-100',
            'badge_border' => 'border-cyan-100',
            'badge_text' => 'text-cyan-700',
        ],
        'Tools & Cloud' => [
            'icon' => '🛠️',
            'bg_gradient' => 'from-violet-50',
            'border_div' => 'border-violet-100',
            'icon_bg' => 'bg-violet-100',
            'badge_border' => 'border-violet-100',
            'badge_text' => 'text-violet-700',
        ],
    ];
@endphp


<section class="bg-white py-24" id="skills">
    <div class="max-w-6xl mx-auto px-6">
        <div class="text-center mb-14">
            <span class="section-tag">What I know</span>
            <h2 class="text-4xl font-bold text-dark mt-2 mb-3">My Skills & Tech Stack</h2>
            <p class="text-gray-500 max-w-md mx-auto">These are the technologies and tools I use to bring projects
                to life.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach ($categories as $categoryName => $meta)
                @php
                    $skills = $technicalSkills->where('category', $categoryName);
                @endphp
                @if ($skills->count() > 0)
                    <!-- {{ $categoryName }} -->
                    <div
                        class="bg-gradient-to-br {{ $meta['bg_gradient'] }} to-white rounded-2xl p-6 border {{ $meta['border_div'] }} card-hover">
                        <div
                            class="w-10 h-10 {{ $meta['icon_bg'] }} rounded-xl flex items-center justify-center mb-4 text-xl">
                            {{ $meta['icon'] }}</div>
                        <h3 class="font-bold text-dark mb-4">{{ $categoryName }}</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($skills as $skill)
                                <span
                                    class="skill-badge bg-white border {{ $meta['badge_border'] }} {{ $meta['badge_text'] }} text-xs font-medium px-3 py-1.5 rounded-full shadow-sm">{{ $skill->title }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</section>
