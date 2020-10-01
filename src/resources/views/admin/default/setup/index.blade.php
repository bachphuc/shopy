@extends(Shopy::adminLayout())

@section('content')
<div style="text-align: center;">
    <div style="max-width: 720px;margin: auto;text-align: left;margin-top:50px;margin-bottom: 50px;">
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