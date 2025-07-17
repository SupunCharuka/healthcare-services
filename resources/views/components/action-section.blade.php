<div {{ $attributes->merge(['class' => '']) }}>
    {{-- <x-section-title>
        <x-slot name="title">{{ $title }}</x-slot>
        <x-slot name="description">{{ $description }}</x-slot>
    </x-section-title> --}}

    <div class="card-body">
        <div class="px-4 py-3 sm:p-6 bg-white shadow sm:rounded-lg">
            {{ $content }}
        </div>
    </div>
</div>
