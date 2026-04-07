<?php

use App\Traits\WithToastr;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component {
    use WithToastr;

    public $messages = [];
    public $selectedMessage = null;

    public function mount()
    {
        $this->loadMessages();
    }

    public function loadMessages()
    {
        $this->messages = \App\Models\ContactMessage::orderBy('created_at', 'desc')->get()->toArray();
    }

    public function viewMessage($id)
    {
        $msg = \App\Models\ContactMessage::findOrFail($id);
        // Mark as read
        if (!$msg->is_read) {
            $msg->update(['is_read' => true]);
            $this->loadMessages();
        }
        $this->selectedMessage = $msg->toArray();
    }

    public function closeMessage()
    {
        $this->selectedMessage = null;
    }

    public function confirmDeleteMessage($id)
    {
        $this->dispatch('swal:contact', [
            'id'                => $id,
            'title'             => 'Delete this message?',
            'text'              => 'This message will be permanently deleted.',
            'icon'              => 'warning',
            'confirmButtonText' => 'Yes, delete it!',
            'cancelButtonText'  => 'Cancel',
        ]);
    }

    #[On('removeContactMessage')]
    public function removeContactMessage($id)
    {
        \App\Models\ContactMessage::findOrFail($id)->delete();
        $this->selectedMessage = null;
        $this->loadMessages();
        $this->dispatch('toast', ['type' => 'success', 'message' => 'Message deleted.']);
    }
};
?>

<div>
    <div class="bg-white p-6 rounded-xl shadow-lg mb-6 border border-gray-100">
        <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center gap-2">
            ✉️ Contact Messages
            @php $unread = collect($messages)->where('is_read', false)->count(); @endphp
            @if($unread)
                <span class="ml-2 bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">{{ $unread }} new</span>
            @endif
        </h2>

        @if(count($messages))

            {{-- Message Detail Modal --}}
            @if($selectedMessage)
                <div class="mb-6 bg-indigo-50 border border-indigo-200 rounded-xl p-6 relative">
                    <button wire:click="closeMessage" class="absolute top-4 right-4 text-gray-400 hover:text-gray-700 text-xl font-bold">✕</button>
                    <div class="flex flex-wrap gap-4 mb-3 text-sm text-gray-600">
                        <span><strong>From:</strong> {{ $selectedMessage['first_name'] }} {{ $selectedMessage['last_name'] }}</span>
                        <span><strong>Email:</strong> <a href="mailto:{{ $selectedMessage['email'] }}" class="text-primary hover:underline">{{ $selectedMessage['email'] }}</a></span>
                        @if($selectedMessage['subject'])
                            <span><strong>Subject:</strong> {{ $selectedMessage['subject'] }}</span>
                        @endif
                        <span class="text-gray-400">{{ \Carbon\Carbon::parse($selectedMessage['created_at'])->diffForHumans() }}</span>
                    </div>
                    <div class="bg-white rounded-xl p-4 border border-indigo-100 text-gray-700 text-sm leading-relaxed whitespace-pre-wrap">{{ $selectedMessage['message'] }}</div>
                    <div class="mt-4 flex gap-3">
                        <a href="mailto:{{ $selectedMessage['email'] }}?subject=Re: {{ $selectedMessage['subject'] }}"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm px-4 py-2 rounded-lg font-semibold">
                            ↩️ Reply via Email
                        </a>
                        <button wire:click="confirmDeleteMessage({{ $selectedMessage['id'] }})"
                            class="bg-red-100 hover:bg-red-200 text-red-600 text-sm px-4 py-2 rounded-lg font-semibold">
                            🗑 Delete
                        </button>
                    </div>
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                    <thead class="bg-indigo-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 w-4"></th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Name</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Email</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Subject</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Received</th>
                            <th class="px-4 py-2 text-center text-sm font-semibold text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($messages as $msg)
                            <tr class="hover:bg-gray-50 transition duration-150 {{ !$msg['is_read'] ? 'bg-indigo-50/50 font-semibold' : '' }}">
                                <td class="px-4 py-2">
                                    @if(!$msg['is_read'])
                                        <span class="inline-block w-2 h-2 bg-indigo-500 rounded-full" title="Unread"></span>
                                    @endif
                                </td>
                                <td class="px-4 py-2 text-gray-800">{{ $msg['first_name'] }} {{ $msg['last_name'] }}</td>
                                <td class="px-4 py-2 text-gray-600">{{ $msg['email'] }}</td>
                                <td class="px-4 py-2 text-gray-600 max-w-xs truncate">{{ $msg['subject'] ?: '—' }}</td>
                                <td class="px-4 py-2 text-gray-400 text-sm">{{ \Carbon\Carbon::parse($msg['created_at'])->diffForHumans() }}</td>
                                <td class="px-4 py-2 text-center">
                                    <div class="flex items-center justify-center gap-3">
                                        <button wire:click="viewMessage({{ $msg['id'] }})"
                                            class="text-indigo-500 hover:text-indigo-700 font-semibold text-sm">
                                            👁 View
                                        </button>
                                        <button wire:click="confirmDeleteMessage({{ $msg['id'] }})"
                                            class="text-red-500 hover:text-red-700 font-semibold text-sm">
                                            🗑 Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-500 text-sm italic">No messages received yet.</p>
        @endif
    </div>
</div>

<script>
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('swal:contact', (event) => {
            let data = event[0];
            Swal.fire({
                title: data.title,
                text: data.text,
                icon: data.icon,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: data.confirmButtonText,
                cancelButtonText: data.cancelButtonText,
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('removeContactMessage', { id: data.id });
                }
            });
        });
    });
</script>
