<x-filament-panels::page>
    <x-filament-panels::form
        id="form" wire:submit.prevent="submit">
        {{ $this->form }}

        <x-filament-panels::form.actions
            :actions="$this->getCachedFormActions()" :full-width="$this->hasFullWidthFormActions()" />
    </x-filament-panels::form>
</x-filament-panels::page>
