<x-app>
<h1 class="h3 mt-3 mb-3">Edit Endpoint</h1>
<div class="row">
	<div class="col-md-3 mb-3">
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
        <form action="{{url('/endpoints')}}/{{ $endpoint->id }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $endpoint->name }}">
            </div>
            <div class="form-group">
                <label>Endpoint Url</label>
                <input type="text" class="form-control @error('endpoint_url') is-invalid @enderror" name="endpoint_url" value="{{ $endpoint->endpoint_url }}">
            </div>
            <div class="form-group">
                <label>Headers <small>(json)</small></label>
                <textarea name="headers" class="form-control @error('headers') is-invalid @enderror" rows=4>{{ $endpoint->headers }}</textarea>
            </div>
            <div class="form-group">
                <label>Data <small>(json)</small></label>
                <textarea name="data" class="form-control @error('data') is-invalid @enderror" rows=4>{{ $endpoint->data }}</textarea>
            </div>
            <input type="submit" value="Update" class="btn btn-dark btn-block">
        </form>
	</div>
</div>
</x-app>