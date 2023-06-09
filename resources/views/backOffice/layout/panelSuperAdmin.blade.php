@include("backOffice.layout.includes.header")

<div class="container-scroller">

    @include("backOffice.layout.includes.navbar")

    <div class="container-fluid page-body-wrapper">

        @include("backOffice.layout.includes.sidebarSuperAdmin")


        <div class="main-panel">
            <div class="content-wrapper">


                @yield('content-wrapper')

            </div>
        </div>
    </div>

</div>

@include("backOffice.layout.includes.footer")
