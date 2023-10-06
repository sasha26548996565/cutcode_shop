@props([
    'resource',
    'field',
    'item'
])
@if($field->isHidden())
    <div class="hidden">{{ $slot }}</div>
@else
    <x-moonshine::form.input-wrapper
        :attributes="$field->attributes()"
        label="{{ $field->label() }}"
        name="{{ $field->name() }}"
    >
        @if($field->hasLink())
            <x-slot:beforeSlot>
                <x-moonshine::link-native
                    icon="heroicons.link"
                    :href="$field->getLinkValue()"
                    :target="$field->isLinkBlank() ? '_blank' : '_self'"
                >
                    {{ $field->getLinkName() }}
                </x-moonshine::link-native>
            </x-slot:beforeSlot>
        @endif

        {{ $slot }}

        @if($field->getHint())
            <x-slot:afterSlot>
                <x-moonshine::form.hint>
                    {{ $field->getHint() }}
                </x-moonshine::form.hint>
            </x-slot:afterSlot>
        @endif
    </x-moonshine::form.input-wrapper>
@endif
