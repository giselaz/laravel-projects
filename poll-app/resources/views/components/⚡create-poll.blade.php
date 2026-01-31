<?php

use Livewire\Component;
use App\Models\Poll;
new class extends Component {
    public $title;
    public array $options;
    protected $rules = [
        'title' => 'required|min:3|max:255',
        'options' => 'required|array|min:1|max:10',
        'options.*' => 'required|min:1|max:255',
    ];
    protected $messages = [
        'options.*' => 'The option can\'t be empty',
    ];
    public function updated($property)
    {
        $this->validateOnly($property);
    }
    public function addOption()
    {
        $this->options[] = '';
    }
    public function removeOption($index)
    {
        unset($this->options[$index]);
        $this->options = array_values($this->options);
    }
    public function createPoll()
    {
        $this->validate();
        Poll::create([
            'title' => $this->title,
        ])
            ->options()
            ->createMany(collect($this->options)->map(fn($option) => ['name' => $option])->all());
        $this->reset('title', 'options');
        session()->flash('success', 'Poll Saved successfully!');
        $this->dispatch('pollCreated');
    }
};
?>
<div class=" flex justify-center items-center">
    <form action="" class="w-250 h-full" wire:submit.prevent='createPoll'>
        @if (session('success'))
            <div class="p-3 mb-4 text-green-800 bg-green-100 rounded" x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)"
                x-show="show" x-transition>
                {{ session('success') }}
            </div>
        @endif
        <label for="title">Title</label>
        <input type="text" wire:model.live.blur='title' placeholder="title"
            class="input @error('title') border-red-500 @enderror">
        @error('title')
            <div class="error"> {{ $message }}</div>
        @enderror
        <div class="mb-4
            mt-4">
            <button class="btn" wire:click.prevent="addOption">Add Option</button>
        </div>

        <div>
            @foreach ($options as $index => $option)
                <div class="mb-4">
                    <label>Option {{ $index + 1 }}</label>
                    <div class="flex gap-2">
                        <input type="text"
                            wire:model.live.blur="options.{{ $index }}"class=' input @error("options.{$index}") border-red-500 @enderror' />
                        <button class="btn" wire:click.prevent="removeOption({{ $index }})">Remove</button>
                    </div>
                    @error("options.{$index}")
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror

                </div>
            @endforeach
        </div>

        @if (count($options) > 0)
            <button type="submit" wire:loading.attr="disabled" wire:target="save" class="btn">

                <svg class="mr-3 size-5 animate-spin ..." viewBox="0 0 24 24" wire:loading wire:target="save">
                    <!-- ... -->
                </svg>
                Create Poll

            </button>
        @endif

    </form>
</div>
