<x-app>
<h1 class="h3 mt-3 mb-3">Register Endpoint</h1>
<div class="row">
	<div class="col-md-3">
        @if(Session::has('success'))
            <div class="alert alert-success">
                {{Session::get('success')}}
            </div>
        @endif
        @if ($errors->any())
		    <div class="alert alert-danger">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif
        <form action="{{url('/endpoints')}}" enctype="multipart/form-data" method="post">
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name">
            </div>
            <div class="form-group">
                <label>Api Source</label>
                <input type="text" class="form-control @error('api_source') is-invalid @enderror" name="api_source">
            </div>
            <div class="form-group">
                <label>Endpoint Url</label>
                <input type="text" class="form-control @error('endpoint_url') is-invalid @enderror" name="endpoint_url">
            </div>
            <div class="form-group">
                <label>Auth <small>(One item per line)</small></label>
                <textarea name="auth" class="form-control @error('auth') is-invalid @enderror" rows=4>email:admin@example.com&#13;&#10;password:123456</textarea>
            </div>
            <input type="submit" name="send" value="Submit" class="btn btn-dark btn-block">
        </form>
	</div>
</div>
</x-app>