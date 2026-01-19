<?php

use App\Traits\WithToastr;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component {
    use WithToastr;

    public function mount()
    {
        $this->services = \App\Models\Service::orderBy('order')->get()->toArray();
    }

    public $services = [];
    public $newService = [
        'title' => '',
        'slug' => '',
        'description' => '',
        'icon' => '',
        'order' => 0,
        'is_active' => true,
    ];

    function loadServices()
    {
        $this->services = \App\Models\Service::orderBy('order')->get()->toArray();
    }

    public function addService()
    {
        \App\Models\Service::create($this->newService);

        $this->newService = [
            'title' => '',
            'slug' => '',
            'description' => '',
            'icon' => '',
            'order' => 0,
            'is_active' => true,
        ];

        $this->loadServices();
        $this->toastSuccess('Service added successfully!');
    }

    public function confirmDeleteService($serviceId)
    {
        $this->dispatch('swal:service', [
            'id' => $serviceId,
            'title' => 'Are you sure?',
            'text' => 'This service will be permanently deleted!',
            'icon' => 'warning',
            'confirmButtonText' => 'Yes, delete it!',
            'cancelButtonText' => 'Cancel',
        ]);
    }

    #[On('removeService')]
    public function removeService($id)
    {
        \App\Models\Service::findOrFail($id)->delete();
        $this->loadServices();

        $this->dispatch('toast', [
            'type' => 'success',
            'message' => 'Service deleted successfully!',
        ]);
    }

    public function toggleStatus($serviceId)
    {
        $service = \App\Models\Service::findOrFail($serviceId);
        $service->is_active = !$service->is_active;
        $service->save();

        $this->loadServices();
        $this->toastSuccess('Service status updated!');
    }
};
?>

<div>
    <div class="bg-white p-6 rounded-xl shadow-lg mb-6 border border-gray-100">
        <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center gap-2">
            💼 Services
        </h2>

        @if (count($services))
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                    <thead class="bg-indigo-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Order</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Title</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Slug</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Description</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Icon</th>
                            <th class="px-4 py-2 text-center text-sm font-semibold text-gray-700">Status</th>
                            <th class="px-4 py-2 text-center text-sm font-semibold text-gray-700">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($services as $service)
                            <tr class="hover:bg-gray-50 transition duration-150">
                                <td class="px-4 py-2 text-gray-800">{{ $service['order'] }}</td>
                                <td class="px-4 py-2 text-gray-800 font-medium">{{ $service['title'] }}</td>
                                <td class="px-4 py-2 text-gray-600">{{ $service['slug'] }}</td>
                                <td class="px-4 py-2 text-gray-600">{{ Str::limit($service['description'], 50) }}</td>
                                <td class="px-4 py-2 text-gray-600">{{ $service['icon'] ?? 'N/A' }}</td>
                                <td class="px-4 py-2 text-center">
                                    <button wire:click="toggleStatus({{ $service['id'] }})"
                                        class="px-3 py-1 rounded-full text-xs font-semibold {{ $service['is_active'] ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                        {{ $service['is_active'] ? '✓ Active' : '✗ Inactive' }}
                                    </button>
                                </td>
                                <td class="px-4 py-2 text-center">
                                    <button wire:click="confirmDeleteService({{ $service['id'] }})"
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
                No services added yet.
            </p>
        @endif



        <!-- ADD NEW SERVICE FORM -->
        <div class="mt-8 bg-gray-50 p-5 rounded-lg border">
            <h3 class="text-lg font-semibold text-gray-700 mb-3">
                Add New Service
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Title</label>
                    <input wire:model="newService.title" placeholder="e.g. Web Design"
                        class="w-full border rounded-lg p-2 focus:ring focus:ring-indigo-200">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Slug</label>
                    <input wire:model="newService.slug" placeholder="e.g. web-design"
                        class="w-full border rounded-lg p-2 focus:ring focus:ring-indigo-200">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Icon</label>
                    <input wire:model="newService.icon" placeholder="Icon class or path"
                        class="w-full border rounded-lg p-2 focus:ring focus:ring-indigo-200">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Order</label>
                    <input wire:model="newService.order" type="number" placeholder="0"
                        class="w-full border rounded-lg p-2 focus:ring focus:ring-indigo-200">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium mb-1">Description</label>
                    <textarea wire:model="newService.description" placeholder="Describe your service" rows="3"
                        class="w-full border rounded-lg p-2 focus:ring focus:ring-indigo-200">
                    </textarea>
                </div>

                <div class="md:col-span-2">
                    <label class="flex items-center gap-2">
                        <input type="checkbox" wire:model="newService.is_active"
                            class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                        <span class="text-sm font-medium">Active</span>
                    </label>
                </div>
            </div>

            <div class="mt-4 text-right">
                <button wire:click="addService"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-lg shadow">
                    ➕ Add Service
                </button>
            </div>
        </div>

    </div>
</div>


<script></script>
