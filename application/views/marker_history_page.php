<script type="text/javascript" src="../js/marker_history.js"></script>
<div class="container">
	<div class="page-header">
	    <h1>Marker History <small></small></h1>
	</div>
	<div class="offset-sm-4 col-sm-8">
		<div class="row">
			<div class="col-sm-6 form-group">
				<label class="control-label" for="marker_observance_timestamp">Timestamp of observance</label>
				<div class="input-group date datetime">
			        <input type="text" class="form-control" id="marker_observance_timestamp" name="observance_timestamp" placeholder="Enter timestamp" aria-required="true" aria-invalid="false">
			        <span class="input-group-addon">
			            <span class="glyphicon glyphicon-calendar"></span>
			        </span>
			    </div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-6 form-group">
				<label class="control-label" for="surficial_observer">Observer's name</label>
				<input type="text" class="form-control" id="surficial_observer">
			</div>
		</div>

		<div class="row">
			<div class="col-sm-6 form-group">
	            <label class="control-label" for="marker_name">Marker name</label>
	            <select class="form-control" id="marker_name" style="height: 40px;">
	            </select>
	        </div>
		</div>


		<div class="row">
			<div class="col-sm-6 form-group">
				<label class="control-label" for="event">Event</label>
				<select class="form-control" name = "event_marker" id="event" style="height: 40px;">
					<option value="na"">----</option>
					<option value="3">Rename</option>
					<option value="2">Reposition</option>
					<option value="4">Removed</option>
				</select>
			</div>
		</div>

		<div class="row" id="new_marker_name_history" style="display:none;">
			<div class="col-sm-6 form-group">
	            <label class="control-label" for="new_marker_name">New Marker name</label>
	            <input class="form-control" id="new_marker_name">
	        </div>
		</div>



		<div class="row" style="display: none;">
			<div class="col-sm-6 form-group">
				<label class="control-label" for="marker_measurement">New</label>
				<input type="text" class="form-control" id="marker_measurement">
			</div>
		</div>
	</div>
	<div class="offset-sm-4 col-sm-8">
		<div class="row text-right">
			<div class="col-sm-3 offset-sm-3 form-group">
				<button type="button" class="btn btn-primary" id="marker_history_save">Save</button>
			</div>
		</div>
	</div>
	
</div>