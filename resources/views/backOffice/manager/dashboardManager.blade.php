@extends("backOffice.layout.panelManager")
<style>
    .cont{
        height: 200px;
        width: 900px;
        /*background-color:cyan;*/
        margin-left: 50px;
        margin-top: 30px;
    }
    .flip-horizontal {
        transform: scaleX(-1);
    }

</style>

@section("title","Tableau de bord")


@section("content-wrapper")

    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold"></h3>
                    <h6 class="font-weight-normal mb-0" style="font-size: 20px !important; padding-top: 120px !important; padding-left: 50px !important;font-family: cursive;">All systems are running smoothly {{ auth()->user()->name }} !
                    {{--                        <span class="text-primary">3 unread alerts!</span></h6>--}}
                </div>
            </div>
        </div>
    </div>

    <div class="cont">
        <div class="row">
            <div class="col-md-4">
                <div class="card card-tale">
                    <div class="card-body" style="background-image:linear-gradient(45deg,#727EE9, #868eca);">
                        <p class="mb-4" style="font-size: 20px;">Remaining calls</p>
                        <p class="fs-30 mb-2">
                            <span class="mr-2">{{ $candidatCount }}</span>
                            <i class= "fas fa-phone flip-horizontal" style="font-size: 30px;padding-right: 170px; "></i>                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-tale">
                    <div class="card-body" style="background-image:  linear-gradient(45deg,#868eca, #b1b5ed);">
                        <p class="mb-4" style="font-size: 20px;">Score</p>
                        <p class="fs-30 mb-2">
                            <span class="mr-2"></span>
                            <i class= "fas fa-trophy" style="font-size: 30px;padding-left:170px;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
