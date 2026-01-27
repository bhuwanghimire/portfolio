<?php

use Livewire\Component;
use Illuminate\Database\Eloquent\Collection;

new class extends Component {
    public string $sectionName;
    public Collection  $technicalSkills;
    public string $description;

    public function boot() : void
    {
        $this->sectionName = 'technical-skill';
        $this->technicalSkills = \App\Models\TechnicalSkill::all();
        $this->description = "I am constantly learning new technologies. Currently, these are the tools and languages I use most frequently in my projects.";
    }
};
?>

<div>
    <span class="text-primary font-semibold tracking-wide uppercase">Expertise</span>
    <h2 class="text-3xl font-bold text-gray-900 mt-2 mb-6">Technical Skills</h2>
    <p class="text-gray-600 mb-8">
        {{ $description }}
    </p>

    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
        @foreach ($technicalSkills as $skill)
        <div
            class="bg-white border border-gray-100 p-4 rounded-xl shadow-sm flex flex-col items-center justify-center hover:border-primary hover:shadow-md transition group">
            <i class="{{ $skill->icon }} text-2xl text-orange-500 mb-2 group-hover:scale-110 transition"></i>

            <span class="font-semibold text-gray-800 text-sm">{{ $skill->title }}</span>
        </div>
            @endforeach
    </div>
</div>
