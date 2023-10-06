<!-- Navigation -->
<div class="layout-navigation">
    @section("header-inner")

    @show

    @includeWhen(config('moonshine.header'), config('moonshine.header'))

    @includeWhen(
        config('moonshine.auth.enable', true),
        'moonshine::layouts.shared.notifications'
    )

    @includeWhen(
        count(config('moonshine.locales', [])) > 1,
        'moonshine::layouts.shared.locales'
    )
</div>
<!-- END: Navigation -->
