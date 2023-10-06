@extends("moonshine::layouts.app")

@section('sidebar-inner')
    @parent
@endsection

@section("header-inner")
    @parent

    @include('moonshine::layouts.shared.breadcrumbs', [
        'items' => [
            $resource->route('index') => $resource->title()
        ]
    ])

    @includeWhen(
        !$resource->isRelatable() && $resource->search(),
        'moonshine::crud.shared.search'
    )
@endsection

@section('content')
    @include('moonshine::layouts.shared.title', [
        'title' => $resource->title(),
        'subTitle' => $resource->subTitle()
    ])

    <x-moonshine::grid>
        @if(!$resource->isRelatable())
            @if(count($metrics))
                <x-moonshine::column class="pb-10">
                    <div class="flex flex-col gap-y-8 gap-x-6 sm:grid sm:grid-cols-12 lg:gap-y-10">
                        @foreach($metrics as $metric)
                            {!! $resource->renderComponent($metric, $resource->getModel()) !!}
                        @endforeach
                    </div>
                </x-moonshine::column>
            @endif
        @endif

        @if($resource->componentsCollection()->indexComponents()->isNotEmpty())
            @foreach($resource->componentsCollection()->indexComponents() as $indexComponent)
                @if($indexComponent->isSee($resource->getModel()))
                    <x-moonshine::column class="pb-10">
                        {{ $resource->renderComponent($indexComponent, $resource->getModel()) }}
                    </x-moonshine::column>
                @endif
            @endforeach
        @endif

        <x-moonshine::column class="flex flex-wrap items-center justify-between gap-2 sm:flex-nowrap">
            <div class="flex items-center gap-2">
                @if($resource->can('create') && in_array('create', $resource->getActiveActions()))
                    @if($resource->isCreateInModal())
                        <x-moonshine::async-modal
                            title="{{ $resource->title() }}"
                            route="{{ $resource->route('create', query: request('related_column') ? ['related_column' => request('related_column'), 'related_key' => request('related_key')] : []) }}"
                            :filled="true"
                        >
                            <x-moonshine::icon
                                icon="heroicons.outline.squares-plus"
                                size="4"
                            />

                            {{ trans('moonshine::ui.create') }}
                        </x-moonshine::async-modal>
                    @else
                        <x-moonshine::link
                            :href="$resource->route('create')"
                            icon="heroicons.outline.squares-plus"
                            :filled="true"
                        >
                            {{ trans('moonshine::ui.create') }}
                        </x-moonshine::link>
                    @endif
                @endif

                @if(!$resource->isRelatable() && $dropdownActions->isNotEmpty())
                    <x-moonshine::dropdown>
                        <x-slot:toggler class="btn">
                            <x-moonshine::icon icon="heroicons.ellipsis-vertical" />
                        </x-slot:toggler>

                        @include('moonshine::crud.shared.dropdown-actions', [
                            'actions' => $dropdownActions
                        ])
                    </x-moonshine::dropdown>
                @endif
            </div>

            @includeWhen(
                !$resource->isRelatable() && $lineActions->isNotEmpty(),
                'moonshine::crud.shared.line-actions',
                [
                    'actions' => $lineActions
                ]
            )
        </x-moonshine::column>

        <x-moonshine::column>
            @if(!empty($resource->queryTags()))
                <div class="flex flex-wrap items-center gap-2">
                    @foreach($resource->queryTags() as $queryTag)
                        <x-moonshine::link
                            :href="$resource->route('query-tag', query: ['queryTag' => $queryTag->uri()])"
                            :filled="request()->routeIs('*.query-tag') && request()->route('queryTag') === $queryTag->uri()"
                            :icon="$queryTag->iconValue()"
                        >
                            {{ $queryTag->label() }}
                        </x-moonshine::link>
                    @endforeach
                </div>
            @endif

            @fragment('crud-table')
                @include($resource->itemsView(), [
                    'resource' => $resource,
                    'resources' => $resources
                ])
            @endfragment
        </x-moonshine::column>
    </x-moonshine::grid>
@endsection
