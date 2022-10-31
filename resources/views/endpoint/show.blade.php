<x-app>
<script type="text/javascript">@include('endpoint.scripts.show-js')</script>
<style type="text/css">@include('endpoint.styles.show')</style>
<h1 class="h3 mt-3 mb-3">Actions</h1>
<div class="row">
	<div class="col-md-1">
        <select id="action" class="form-control mb-3">
            <option selected>GET</option>
            <option>POST</option>
            <option>PUT</option>
            <option>DELETE</option>
        </select>
	</div>
    <div class="col-md-6">
        <input type="text" id="text-field-endpoint" value="{{ $endpoint->endpoint_url }}" class="form-control">
    </div>
    <div class="col-md-1">
        <button id="btn-submit" class="btn btn-dark btn-block">Submit</button>
    </div>
    <div class="col-md-2">
       <button class="btn btn-primary" id="filters-toggle">Toggle Filters</button>
    </div>
    <div class="col-xl-12">
        <div id="error-msg" class="col-xl-12 alert alert-danger" role="alert" hidden></div>
    </div>
    <div id="section-filters" class="col-xl-12 mb-3" hidden>
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Filters</h5>
            </div>
            <div class="card-body mb-0">
                <div id="filters" class="row"></div>
            </div>
        </div>
    </div>
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Response Data</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="indexTable">
                    <thead>
                        <tr></tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr></tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
</x-app>