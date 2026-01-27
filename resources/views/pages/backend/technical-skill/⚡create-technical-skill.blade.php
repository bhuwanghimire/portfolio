<?php

use App\Traits\WithToastr;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component {
    use WithToastr;

    public function mount()
    {
        $this->technicalSkills = \App\Models\TechnicalSkill::orderBy('order')->get()->toArray();
    }

    public $technicalSkills = [];
    public $newSkill = [
        'title' => '',
        'icon' => '',
        'order' => 0,
        'is_active' => true,
    ];
    public  $buttonText = 'Add Technical Skill';
    public $action = 'addSkill';
    public $activeSkillId = null;

    function loadSkills()
    {
        $this->technicalSkills = \App\Models\TechnicalSkill::orderBy('order')->get()->toArray();
    }

    public function addSkill()
    {
        \App\Models\TechnicalSkill::create($this->newSkill);

        $this->newSkill = [
            'title' => '',
            'icon' => '',
            'order' => 0,
            'is_active' => true,
        ];

        $this->loadSkills();
        $this->toastSuccess('Technical skill added successfully!');
    }

    public function confirmDeleteSkill($skillId)
    {
        $this->dispatch('swal:skill', [
            'id' => $skillId,
            'title' => 'Are you sure?',
            'text' => 'This technical skill will be permanently deleted!',
            'icon' => 'warning',
            'confirmButtonText' => 'Yes, delete it!',
            'cancelButtonText' => 'Cancel',
        ]);
    }

    #[On('removeSkill')]
    public function removeSkill($id)
    {
        \App\Models\TechnicalSkill::findOrFail($id)->delete();
        $this->loadSkills();

        $this->dispatch('toast', [
            'type' => 'success',
            'message' => 'Technical skill deleted successfully!',
        ]);
    }

    public function toggleStatus($skillId)
    {
        $skill = \App\Models\TechnicalSkill::findOrFail($skillId);
        $skill->is_active = !$skill->is_active;
        $skill->save();

        $this->loadSkills();
        $this->toastSuccess('Skill status updated!');
    }

    public function editSkill($skillId)
    {
        $this->buttonText = 'Update Technical Skill';
        $this->action = 'updateSkill';
        $this->activeSkillId = $skillId;
        $skill = \App\Models\TechnicalSkill::findOrFail($skillId);
        $this->newSkill = $skill->toArray();
    }

    public function updateSkill(){
        $skill = \App\Models\TechnicalSkill::findOrFail($this->activeSkillId);
        $skill->update($this->newSkill);
        $this->loadSkills();
        $this->reset(['buttonText', 'action', 'activeSkillId', 'newSkill']);
        $this->toastSuccess('Technical skill updated successfully!');
    }
};
?>

<div>
    <div class="bg-white p-6 rounded-xl shadow-lg mb-6 border border-gray-100">
        <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center gap-2">
            🛠️ Technical Skills
        </h2>

        @if (count($technicalSkills))
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                    <thead class="bg-indigo-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Order</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Title</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Icon</th>
                            <th class="px-4 py-2 text-center text-sm font-semibold text-gray-700">Status</th>
                            <th class="px-4 py-2 text-center text-sm font-semibold text-gray-700">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($technicalSkills as $skill)
                            <tr class="hover:bg-gray-50 transition duration-150">
                                <td class="px-4 py-2 text-gray-800">{{ $skill['order'] }}</td>
                                <td class="px-4 py-2 text-gray-800 font-medium">{{ $skill['title'] }}</td>
                                <td class="px-4 py-2 text-gray-600">
                                    @if ($skill['icon'])
                                        <span class="flex items-center gap-2">
                                            <i class="{{ $skill['icon'] }}"></i>
                                            <span class="text-xs text-gray-500">{{ $skill['icon'] }}</span>
                                        </span>
                                    @else
                                        <span class="text-gray-400">N/A</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2 text-center">
                                    <button wire:click="toggleStatus({{ $skill['id'] }})"
                                        class="px-3 py-1 rounded-full text-xs font-semibold {{ $skill['is_active'] ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                        {{ $skill['is_active'] ? '✓ Active' : '✗ Inactive' }}
                                    </button>
                                </td>
                                <td class="px-4 py-2 text-center">
                                    <button wire:click="confirmDeleteSkill({{ $skill['id'] }})"
                                        class="text-red-500 hover:text-red-700 font-semibold">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                    <button wire:click="editSkill({{ $skill['id'] }})"
                                            class="text-blue-500 hover:text-blue-700 font-semibold">
                                       <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-500 text-sm italic">
                No technical skills added yet.
            </p>
        @endif



        <!-- ADD NEW TECHNICAL SKILL FORM -->
        <div class="mt-8 bg-gray-50 p-5 rounded-lg border">
            <h3 class="text-lg font-semibold text-gray-700 mb-3">
                Add New Technical Skill
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Title</label>
                    <input wire:model="newSkill.title" placeholder="e.g. Laravel, React, Python"
                        class="w-full border rounded-lg p-2 focus:ring focus:ring-indigo-200">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Icon</label>
                    <input wire:model="newSkill.icon" placeholder="e.g. fab fa-laravel, devicon-react-original"
                        class="w-full border rounded-lg p-2 focus:ring focus:ring-indigo-200">
                    <p class="text-xs text-gray-500 mt-1">FontAwesome or Devicon class</p>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Order</label>
                    <input wire:model="newSkill.order" type="number" placeholder="0"
                        class="w-full border rounded-lg p-2 focus:ring focus:ring-indigo-200">
                </div>

                <div class="flex items-center">
                    <label class="flex items-center gap-2">
                        <input type="checkbox" wire:model="newSkill.is_active"
                            class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                        <span class="text-sm font-medium">Active</span>
                    </label>
                </div>
            </div>

            <div class="mt-4 text-right">
                <button wire:click="{{$action}}"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-lg shadow">
                    ➕ {{$buttonText}}
                </button>

            </div>
        </div>

    </div>
</div>


<script></script>
