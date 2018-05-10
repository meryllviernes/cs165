<script type="text/javascript" src="../js/moms.js"></script>
<div class="container">
	<div class="page-header">
	    <h1>Manifestation of Movement <small>Update / Delete data</small></h1>
	</div>
	<div class="col-sm-12">
		<div class="row">
			<div class="form-group col-sm-4">
				<label class="control-label" for="moms_date">Date: </label>
			    <div class="input-group date datetime">
			        <input type="text" class="form-control" id="moms_date" placeholder="Enter timestamp" aria-required="true" aria-invalid="false">
			        <span class="input-group-addon">
			            <span class="glyphicon glyphicon-calendar"></span>
			        </span>
			    </div>

			</div>
			<div class="form-group col-sm-2">
				<button type="button" id = "submit_mom_date" class="btn btn-primary" style="margin-top: 25px;">Submit</button>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="form-group col-sm-11">
					<div>          
				        <table class="table" id="moms_table" style="width:100%;">
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
	</div>
</div>

<!-- moms update modal -->
<div class="modal fade" id="update-moms-modal" role="dialog">
  <div class="modal-dialog" id="update-moms-modal-dialog">
    <div class="modal-content" id="update-moms-content">
      <div class="modal-header">
        <h4>Update Manifestation</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body"> 
        <div class="form-group">
        	<textarea class="form-control" rows="5" id="report_update_narrative"></textarea>
        </div>
        <div class="form-group right-content" id="submit-gintag">
          <button type="reset" class="btn btn-danger" id="cancel-update" data-dismiss="modal">Cancel</button>
          <button type="submit" value="submit" id="confirm_moms" class="btn btn-primary">Confirm</button>
        </div>  
      </div>
    </div>  
  </div>
</div>

<!-- moms update modal -->
<div class="modal fade" id="delete-moms-modal" role="dialog">
  <div class="modal-dialog" id="delete-moms-modal-dialog">
    <div class="modal-content" id="delete-moms-content">
      <div class="modal-header">
        <h4>Delete Manifestation</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body"> 
        <div class="form-group">
        	<span>Are you sure you want to delete this data?</span>
        </div>
        <div class="form-group right-content" id="submit-gintag">
          <button type="reset" class="btn btn-danger" id="cancel-update" data-dismiss="modal">Cancel</button>
          <button type="submit" value="submit" id="delete_moms" class="btn btn-primary">Confirm</button>
        </div>  
      </div>
    </div>  
  </div>
</div>