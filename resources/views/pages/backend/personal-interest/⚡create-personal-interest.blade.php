<?php

use App\Traits\WithToastr;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component {
    use WithToastr;

    public function mount()
    {
        $this->personalInterests = \App\Models\PersonalInterest::orderBy('order')->get()->toArray();
    }

    public $personalInterests = [];
    public $newInterest = [
        'title' => '',
        'icon' => '',
        'order' => 0,
        'is_active' => true,
    ];

    function loadInterests()
    {
        $this->personalInterests = \App\Models\PersonalInterest::orderBy('order')->get()->toArray();
    }

    public function addInterest()
    {
        \App\Models\PersonalInterest::create($this->newInterest);

        $this->newInterest = [
            'title' => '',
            'icon' => '',
            'order' => 0,
            'is_active' => true,
        ];

        $this->loadInterests();
        $this->toastSuccess('Personal interest added successfully!');
    }

    public function confirmDeleteInterest($interestId)
    {
        $this->dispatch('swal:interest', [
            'id' => $interestId,
            'title' => 'Are you sure?',
            'text' => 'This personal interest will be permanently deleted!',
            'icon' => 'warning',
            'confirmButtonText' => 'Yes, delete it!',
            'cancelButtonText' => 'Cancel',
        ]);
    }

    #[On('removeInterest')]
    public function removeInterest($id)
    {
        \App\Models\PersonalInterest::findOrFail($id)->delete();
        $this->loadInterests();

        $this->dispatch('toast', [
            'type' => 'success',
            'message' => 'Personal interest deleted successfully!',
        ]);
    }

    public function toggleStatus($interestId)
    {
        $interest = \App\Models\PersonalInterest::findOrFail($interestId);
        $interest->is_active = !$interest->is_active;
        $interest->save();

        $this->loadInterests();
        $this->toastSuccess('Interest status updated!');
    }
};
?>

<div>
    <div class="bg-white p-6 rounded-xl shadow-lg mb-6 border border-gray-100">
        <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center gap-2">
            🎯 Personal Interests
        </h2>

        @if (count($personalInterests))
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
                        @foreach ($personalInterests as $interest)
                            <tr class="hover:bg-gray-50 transition duration-150">
                                <td class="px-4 py-2 text-gray-800">{{ $interest['order'] }}</td>
                                <td class="px-4 py-2 text-gray-800 font-medium">{{ $interest['title'] }}</td>
                                <td class="px-4 py-2 text-gray-600">
                                    @if ($interest['icon'])
                                        <span class="flex items-center gap-2">
                                            <i class="{{ $interest['icon'] }}"></i>
                                            <span class="text-xs text-gray-500">{{ $interest['icon'] }}</span>
                                        </span>
                                    @else
                                        <span class="text-gray-400">N/A</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2 text-center">
                                    <button wire:click="toggleStatus({{ $interest['id'] }})"
                                        class="px-3 py-1 rounded-full text-xs font-semibold {{ $interest['is_active'] ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                        {{ $interest['is_active'] ? '✓ Active' : '✗ Inactive' }}
                                    </button>
                                </td>
                                <td class="px-4 py-2 text-center">
                                    <button wire:click="confirmDeleteInterest({{ $interest['id'] }})"
                                        class="text-red-500 hover:text-red-700 font-semibold">
                                        🗑 Delete
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-500 text-sm italic">
                No personal interests added yet.
            </p>
        @endif



        <!-- ADD NEW PERSONAL INTEREST FORM -->
        <div class="mt-8 bg-gray-50 p-5 rounded-lg border">
            <h3 class="text-lg font-semibold text-gray-700 mb-3">
                Add New Personal Interest
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Title</label>
                    <input wire:model="newInterest.title" placeholder="e.g. Photography, Gaming, Travel"
                        class="w-full border rounded-lg p-2 focus:ring focus:ring-indigo-200">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Icon</label>
                    <input wire:model="newInterest.icon" placeholder="e.g. fas fa-camera, fas fa-gamepad"
                        class="w-full border rounded-lg p-2 focus:ring focus:ring-indigo-200">
                    <p class="text-xs text-gray-500 mt-1">FontAwesome or emoji</p>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Order</label>
                    <input wire:model="newInterest.order" type="number" placeholder="0"
                        class="w-full border rounded-lg p-2 focus:ring focus:ring-indigo-200">
                </div>

                <div class="flex items-center">
                    <label class="flex items-center gap-2">
                        <input type="checkbox" wire:model="newInterest.is_active"
                            class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                        <span class="text-sm font-medium">Active</span>
                    </label>
                </div>
            </div>

            <div class="mt-4 text-right">
                <button wire:click="addInterest"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-lg shadow">
                    ➕ Add Personal Interest
                </button>
            </div>
        </div>

    </div>
</div>


<script></script>
