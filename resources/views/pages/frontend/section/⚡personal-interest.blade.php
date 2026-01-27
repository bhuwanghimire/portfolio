<?php

use Livewire\Component;
use Illuminate\Database\Eloquent\Collection;

new class extends Component {
    public string $sectionName;
    public Collection  $personalInterests;
    public  string $description;
    public function boot() : void
    {
        $this->sectionName = 'personal-interest';
        $this->personalInterests = \App\Models\PersonalInterest::all();
        $this->description = "I'm a passionate developer with a strong focus on creating user-friendly and efficient digital products. My expertise lies in building responsive and scalable websites using modern technologies and best practices.";
    }
};
?>

<div>
    <span class="text-primary font-semibold tracking-wide uppercase">Personal</span>
    <h2 class="text-3xl font-bold text-gray-900 mt-2 mb-6">Interests</h2>
    <div class="grid grid-cols-2 sm:grid-cols-3 gap-6">
        @foreach($personalInterests as $personalInterest)
            <div
                class="aspect-square rounded-2xl bg-white shadow-sm flex flex-col items-center justify-center border border-gray-100 hover:border-primary transition group">
                <i class="{{ $personalInterest->icon }} text-2xl text-orange-500 mb-2 group-hover:scale-110 transition"></i>
                <span class="font-medium text-gray-900">{{ $personalInterest->title }}</span>
            </div>

        @endforeach

    </div>
</div>
