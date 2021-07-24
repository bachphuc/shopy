@extends(Shopy::adminLayout())

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-10">
			@if (count($errors) > 0)
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
			@endif
			<div class="card">
				<div class="card-header" data-background-color="purple">
                    @if(isset($title))<h4 class="title">{{$title}}</h4>@endif
                    @if(isset($subTitle))<p class="category">{{$subTitle}}</p>@endif
				</div>
				<div class="card-content card-body">
					{!! $form->render() !!}
				</div>
			</div>
		</div>
	</div>
</div>  
@endsection