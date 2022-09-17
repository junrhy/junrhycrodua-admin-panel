<x-app>
<style type="text/css">
.timeline {
    list-style-type: none;
    position: relative
}

.timeline:before {
    background: #dee2e6;
    left: 9px;
    width: 2px;
    height: 100%
}

.timeline-item:before,
.timeline:before {
    content: " ";
    display: inline-block;
    position: absolute;
    z-index: 1
}

.timeline-item:before {
    background: #fff;
    border-radius: 50%;
    border: 3px solid #3b7ddd;
    left: 0;
    width: 20px;
    height: 20px
}
.card {
    margin-bottom: 24px;
    box-shadow: 0 0 0.875rem 0 rgba(33,37,41,.05);
}
.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: initial;
    border: 0 solid transparent;
    border-radius: .25rem;
}
.card-body {
    flex: 1 1 auto;
    padding: 1.25rem;
}
.card-header:first-child {
    border-radius: .25rem .25rem 0 0;
}
.card-header {
    border-bottom-width: 1px;
}
.pb-0 {
    padding-bottom: 0!important;
}
.card-header {
    padding: 1rem 1.25rem;
    margin-bottom: 0;
    background-color: #fff;
    border-bottom: 0 solid transparent;
}
</style>

<h1 class="h3 mt-3 mb-3">Endpoints</h1>
<div class="row">
	<div class="col-xl-8">
		<div class="card">
			<div class="card-header pb-0">
				<div class="card-actions float-right">
					<div class="dropdown show">
						<a href="#" data-toggle="dropdown" data-display="static">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal align-middle"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
						</a>

						<div class="dropdown-menu dropdown-menu-right">
							<a class="dropdown-item" href="#">Register</a>
							<a class="dropdown-item" href="#">Activate</a>
							<a class="dropdown-item" href="#">Deactivate</a>
							<a class="dropdown-item" href="#">Remove</a>
						</div>
					</div>
				</div>
				<h5 class="card-title mb-0">Endpoints</h5>
			</div>
			<div class="card-body">
				<table class="table table-striped" style="width:100%">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>API Source</th>
							<th>Endpoint url</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><input type="checkbox" name=""></td>
							<td><a href="#">Addresses</a></td>
							<td><a href="#">JC API</a></td>
							<td>https://api.junrhycrodua.com/addresses</td>
							<td><span class="badge bg-success">Active</span></td>
						</tr>
						<tr>
							<td><input type="checkbox" name=""></td>
							<td><a href="#">Brands</a></td>
							<td><a href="#">JC API</a></td>
							<td>https://api.junrhycrodua.com/brands</td>
							<td><span class="badge bg-warning">Inactive</span></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div class="col-xl-4">
		<div class="card">
			<div class="card-header">
				<div class="card-actions float-right">
					<div class="dropdown show">
						<a href="#" data-toggle="dropdown" data-display="static">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal align-middle"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
						</a>

						<div class="dropdown-menu dropdown-menu-right">
							<a class="dropdown-item" href="#">View Records</a>
						</div>
					</div>
				</div>
				<h5 class="card-title mb-0">Brands</h5>
			</div>
			<div class="card-body">
				<div class="row g-0">
					<div class="col-sm-9 col-xl-12 col-xxl-9">
						<strong>About</strong>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore
							magna aliqua.</p>
					</div>
				</div>

				<table class="table table-sm mt-2 mb-4">
					<tbody>
						<tr>
							<th><input type="checkbox" checked="checked" name=""> id</th>
						</tr>
						<tr>
							<th><input type="checkbox" checked="checked" name=""> name</th>
						</tr>
						<tr>
							<th><input type="checkbox" checked="checked" name=""> created</th>
						</tr>
						<tr>
							<th><input type="checkbox" name=""> updated <span class="badge bg-danger">hidden</span></th>
						</tr>
					</tbody>
				</table>

				<strong>Activity</strong>

				<ul class="timeline mt-2 mb-0">
					<li class="timeline-item">
						<strong>Created #1204</strong>
						<span class="float-right text-muted text-sm">2h ago</span>
						<p>Record Name</p>
					</li>
					<li class="timeline-item">
						<strong>Created #1204</strong>
						<span class="float-right text-muted text-sm">2h ago</span>
						<p>Record Name</p>
					</li>
					<li class="timeline-item">
						<strong>Created #1204</strong>
						<span class="float-right text-muted text-sm">2h ago</span>
						<p>Record Name</p>
					</li>
					<li class="timeline-item">
						<strong>Created #1204</strong>
						<span class="float-right text-muted text-sm">2h ago</span>
						<p>Record Name</p>
					</li>
					<li class="timeline-item">
						<strong>Created #1204</strong>
						<span class="float-right text-muted text-sm">2h ago</span>
						<p>Record Name</p>
					</li>
				</ul>

			</div>
		</div>
	</div>
</div>
</x-app>