<script type="text/javascript" src="../js/moms.js"></script>
<div class="container">
	<div class="page-header">
	    <h1>Manifestation of Movement <small></small></h1>
	</div>
	<div class="col-sm-12">
		<div class="row">

			<div class="form-group col-sm-6">
                <label class="control-label" for="feature_type">Feature Type</label>
                <select class="form-control" id="feature_type" style="height: 40px;">
                	<option value="0">----</option>
                    <option value="1">Crack</option>
                    <option value="2">Pond</option>
                    <option value="4">Scarp</option>
                    <option value="7">Fail</option>
                    <option value="8">Tilted Trees</option>
                    <option value="9">Damaged Structures</option>
                    <option value="5">Bulge</option>
                    <option value="6">Depression</option>
                    <option value="3">Seepage</option>
                </select>
            </div>

			<div class="form-group col-sm-6">
	            <label class="control-label" for="feature_name">Feature Name</label>
	            <select class="form-control" id="feature_name" style="height: 40px;">
                    <option value="">---</option>
                </select>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-6 form-group">
			    <label class="control-label" for="observance_timestamp">Timestamp of Observance</label>
			    <div class="input-group date datetime">
			        <input type="text" class="form-control" id="observance_timestamp" placeholder="Enter timestamp" aria-required="true" aria-invalid="false">
			        <span class="input-group-addon">
			            <span class="glyphicon glyphicon-calendar"></span>
			        </span>
			    </div>
			</div>
			
			<div class="form-group col-sm-6">
	            <label class="control-label" for="reported_by">Reported by</label>
				<input type="text" id="reported_by" class="form-control">
			</div>
		</div>
		<div class="row">
			<div class="col-sm-9">
				<div class="form-group">
				  <label for="comment">Report narrative</label>
				  <textarea class="form-control" rows="5" id="report_narative"></textarea>
				</div>
			</div>
		</div>
		<div class="row text-right">
			<div class="col-sm-3 offset-sm-9">
				<button type="button" class="btn btn-primary" id="submit_moms">Save</button>
			</div>
		</div>
	</div>

</div>