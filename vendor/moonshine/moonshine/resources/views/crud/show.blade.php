@extends("moonshine::layouts.app")

@section('sidebar-inner')
    @parent
@endsection

@section('header-inner')
    @parent

    @include('moonshine::layouts.shared.breadcrumbs', [
        'items' => [
            $resource->route('index') => $resource->title(),
            '#' => $item->{$resource->titleField()} ?? $item->getKey() ?? trans('moonshine::ui.create')
        ]
    ])
@endsection

@section('content')
    @fragment('crud-detail')
    @include($resource->detailView(), [
        'resource' => $resource,
        'item' => $item
    ])
    @endfragment
@endsection
