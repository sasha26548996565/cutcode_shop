<div x-data="{morphType: '{{ $element->formTypeValue($item) }}'}">
    <x-moonshine::form.select
        :name="str($element->name())->replace($element->field(), $element->getMorphType($item))"
        x-model="morphType"
        required="required"
        :values="$element->getTypes()"
    />

    <hr class="divider" />

    <x-moonshine::form.select
        :attributes="$element->attributes()->merge([
        'id' => $element->id(),
        'placeholder' => $element->label() ?? '',
        'name' => $element->name(),
    ])"
        :nullable="false"
        :searchable="true"
        @class(['form-invalid' => $errors->has($element->name())])
        x-bind:data-async-extra="morphType"
        :value="$element->formViewValue($item)"
        :values="$element->values()"
        :asyncRoute="route('moonshine.search.relations', [
            'resource' => $resource->uriKey(),
            'column' => $element->field(),
        ])"
    >
    </x-moonshine::form.select>
</div>
