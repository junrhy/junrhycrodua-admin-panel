<x-app>
<style type="text/css">@include('endpoint.styles.index')</style>
<script type="text/javascript">@include('endpoint.scripts.index-js')</script>
<h1 class="h3 mt-3 mb-3">Endpoints</h1>
<div class="row">
	<div class="col-xl-12">
		<div class="card">
			<div class="card-header pb-0">
				<div class="card-actions float-right">
					<div class="dropdown show">
						<a href="#" data-toggle="dropdown" data-display="static">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal align-middle"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
						</a>

						<div class="dropdown-menu dropdown-menu-right">
							<a class="dropdown-item" href="endpoints/create">Register</a>
							<a class="dropdown-item" id="duplicate-endpoints">Duplicate</a>
							<a class="dropdown-item" id="remove-endpoints">Remove</a>
						</div>
					</div>
				</div>
				<h5 class="card-title mb-0">Registered Endpoints</h5>
			</div>
			<div class="card-body">
				<table class="table table-striped" style="width:100%">
					<thead>
						<tr>
							<th></th>
							<th>Name</th>
							<th>Endpoint url</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach($endpoints as $endpoint)
						<tr>
							<td><input type="checkbox" name="endpoints" value="{{ $endpoint->id }}"></td>
							<td><a href="/endpoints/{{ $endpoint->id }}/edit">{{ $endpoint->name }}</a></td>
							<td>{{ $endpoint->endpoint_url }}</td>
							<td>
								<a href="/endpoints/{{ $endpoint->id }}" class="btn btn-sm btn-warning">View Actions</a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
</x-app>