<?php

use Livewire\Component;

new class extends Component
{
   public $title;
};
?>

<div>
    <form action="">
        <label for="title"> Title</label>
        <input type="text" name="title" wire:model="title">
        <div>Current title {{$title}}</div>
    </form>
</div>