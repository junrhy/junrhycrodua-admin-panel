<x-app>
<script type="text/javascript">@include('endpoint.scripts.show-js')</script>
<style type="text/css">@include('endpoint.styles.show')</style>
<h1 class="h3 mt-3 mb-3">Actions</h1>
<div class="row">
	<div class="col-md-1 mb-3">
        <select id="action" class="form-control mb-3">
            <option selected>GET</option>
            <option>POST</option>
            <option>PUT</option>
            <option>DELETE</option>
        </select>
	</div>
    <div class="col-md-6 mb-3">
        <input type="text" id="text-field-endpoint" value="{{ $endpoint->endpoint_url }}" class="form-control">
    </div>
    <div class="col-md-1 mb-3">
        <button id="btn-submit" class="btn btn-dark btn-block">Submit</button>
    </div>
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Response Data</h5>
            </div>
            <div class="card-body">
                <div id="dateRange" class="row"></div>
                <div id="toggleColumn" class="row mt-2"></div>
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