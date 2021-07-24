@extends(Shopy::adminLayout())

@push('styles')
<style>
    .setup_cover_wrap{
        overflow: hidden;
        padding-bottom: 35%;
        position: absolute;
        left: 0;
        right:0;
        top: 0;
    }
    .setup_cover{
        background-image: url('{{asset('cover.jpg')}}');
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
        position: absolute;
        left: 0;
        right:0;
        top: 0;
        bottom: 0px;
        filter: blur(15px);
        transform: scale(1.1);
    }
    .setup-wrapper{
        text-align: center;padding-top:1px;
    }
    .setup-wrapper > div{
        max-width: 720px;margin: auto;text-align: left;margin-top:50px;margin-bottom: 50px;
    }
</style>
@endpush

@section('content')
<div class="setup_cover_wrap">
    <div class="setup_cover"></div>
</div>
<div class="setup-wrapper">
    <div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header" data-background-color="green">
                            <h4 class="title">Setup</h4>
                            <p class="category">Follow steps to finish setup your shop.</p>
                        </div>
                        <div class="card-body card-content">
                            <div>
                                {!! $formStep->render() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection