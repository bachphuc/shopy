@if(session()->has('message') || session()->has('error'))
    <div class="container mt-4 mb-4">   
        <div class="row">
            <div class="col-md-12">
                @if(session()->has('message'))
                <div class="alert alert-success" role="alert">{{session('message')}}</div>
                @endif
    
                @if(session()->has('error'))
                <div class="alert alert-danger" role="alert">{{session('error')}}</div>
                @endif
            </div>
        </div>
    </div>
@endif