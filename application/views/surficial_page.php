<script type="text/javascript" src="../js/surficial.js"></script>
<div class="container">
	<div class="page-header">
	    <h1>Surficial <small></small></h1>
	</div>
	<div class="offset-sm-4 col-sm-8">
		<div class="row">
			<div class="col-sm-6 form-group">
				<label class="control-label" for="observance_timestamp">Timestamp of observance</label>
				<div class="input-group date datetime">
			        <input type="text" class="form-control" id="observance_timestamp" name="observance_timestamp" placeholder="Enter timestamp" aria-required="true" aria-invalid="false">
			        <span class="input-group-addon">
			            <span class="glyphicon glyphicon-calendar"></span>
			        </span>
			    </div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 form-group">
				<label class="radio-inline">
				<input type="radio" name="surficial_event_optradio" value="0">Routine</label>
				<label class="radio-inline">
				<input type="radio" name="surficial_event_optradio" value="1">Event</label>
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
				<label class="control-label" for="weather">Weather</label>
				<select class="form-control" id="weather" style="height: 40px;">
                    <option value="">---</option>
                </select>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 form-group">
				<label class="control-label" for="marker_name">Marker name</label>
				<select class="form-control" id="marker_name" style="height: 40px;">
                    <option value="">---</option>
                </select>
			</div>   
		</div>
		<div class="row">
			<div class="col-sm-6 form-group">
				<label class="control-label" for="marker_measurement">Measurement (cm)</label>
				<input type="text" class="form-control" id="marker_measurement">
			</div>
		</div>
		<div class="row text-right">
			<div class="col-sm-3 offset-sm-3 form-group">
				<button type="surficial_new_feature" class="btn btn-primary">Add new feature</button>
			</div>
		</div>
	</div>
	<div class="offset-sm-4 col-sm-8">
		<div class="row text-right">
			<div class="col-sm-3 offset-sm-3 form-group">
				<button type="button" class="btn btn-primary" id="surficial_save">Save</button>
			</div>
		</div>
	</div>
	
</div>