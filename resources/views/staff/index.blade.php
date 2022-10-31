<x-app>
<style type="text/css">@include('staff.styles.index')</style>
<script type="text/javascript">@include('staff.scripts.index-js')</script>
<h1 class="h3 mt-3 mb-3">Staffs</h1>
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
							<a class="dropdown-item" href="staffs/create">Add Staff</a>
							<a class="dropdown-item" id="duplicate-staffs">Duplicate</a>
							<a class="dropdown-item" id="remove-staffs">Remove</a>
						</div>
					</div>
				</div>
				<h5 class="card-title mb-0">Accounts</h5>
			</div>
			<div class="card-body">
				<table class="table table-striped" style="width:100%">
					<thead>
						<tr>
							<th></th>
							<th>Email</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Contact</th>
							<th>Status</th>
							<th>Roles</th>
						</tr>
					</thead>
					<tbody>
						@foreach($staffs as $staff)
						<tr>
							<td><input type="checkbox" name="staffs" value="{{ $staff->id }}"></td>
							<td><a href="/staffs/{{ $staff->id }}/edit">{{ $staff->email }}</a></td>
							<td>{{ $staff->first_name }}</td>
							<td>{{ $staff->last_name }}</td>
							<td>{{ $staff->contact_no }}</td>
							<td></td>
							<td>{{ $staff->roles }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
</x-app>