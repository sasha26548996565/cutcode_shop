<x-moonshine::form.range
    :uniqueId="$element->id()"
    :attributes="$element->attributes()"
    :fromValue="$element->formViewValue($item)[$element->fromField] ?? $element->min"
    :toValue="$element->formViewValue($item)[$element->toField] ?? $element->max"
    fromName="{{ $element->name() }}[{{ $element->fromField }}]"
    toName="{{ $element->name() }}[{{ $element->toField }}]"
    fromField="{{ $element->field() }}.{{ $element->fromField }}"
    toField="{{ $element->field() }}.{{ $element->toField }}"
    @class(['form-invalid' => $errors->has($element->name())])
/>
