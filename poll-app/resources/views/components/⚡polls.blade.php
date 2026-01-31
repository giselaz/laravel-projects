<?php

use Livewire\Component;
use App\Models\Poll;
use Illuminate\Support\Collection;
use App\Models\Option;
new class extends Component {
    public Collection $polls;
    protected $listeners = [
        'pollCreated' => 'mount',
    ];
    public function mount()
    {
        $this->polls = Poll::with('options.votes')->latest()->get();
    }
    public function addVote(Option $option)
    {
        $option->votes()->create();
    }
};
?>

<div>

    @forelse ($polls as $poll)
        <div class="flex-col justify-center mb-4">
            <h3 class="mb-4 text-lg font-semibold">{{ $poll->title }}</h3>
            @foreach ($poll->options as $option)
                <div class="mb-2 flex justify-center items-center gap-3 text-base ">
                    <button class="btn" wire:click='addVote({{ $option }})'>Vote</button>
                    <span>{{ $option->name }} </span>

                    <span> ({{ $option->votes->count() }})</span>
                </div>
            @endforeach
        </div>
    @empty
        <div class="text-gray-500">No Polls to show</div>
    @endforelse
</div>
