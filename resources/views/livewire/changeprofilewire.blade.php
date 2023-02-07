<div>
    <label for="name">Name:</label>
    <div x-data="{ lbl: true, inp: false }">
        <div x-show="lbl">
            <p>{{ $name }}</p>
        </div>
        <div x-show="inp">
            <input type="text" wire:model="name">
        </div>
        <button class="button button-blue" @click="inp=true" >Edit</button>
    </div>
</div>
