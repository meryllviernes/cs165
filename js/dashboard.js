$(document).ready(function() {

    $("#surficial-plot").attr("src","../analysis/surficial"+sessionStorage['site_id']+".png");

	let data = {
		"site_id": sessionStorage['site_id']
	}
    let surficial_dashboard_table = $('#surficial_dashboard_table').DataTable( {
        "processing": true,
        "serverSide": false,
        "ajax": {"url": '../dashboard/surficial_data', "type": "POST","data": data},
        columns: [
            { "data" : "ts" , title:"Timestamp"},
            { "data" : "meas", title:"Measurement"},
            { "data" : "name", title:"Name"}
        ],
        "columnDefs": [
		    { "width": "30%", "targets": 0 },
		    { "width": "30%", "targets": 1 },
		    { "width": "30%", "targets": 2 },
		  ],
        "order": [[ 0, "desc" ],[2,"asc"]]
    });

    let moms_dashboard_table = $('#moms_dashboard_table').DataTable( {
        "processing": true,
        "serverSide": false,
        "ajax": {"url": '../dashboard/moms_data', "type": "POST","data": data},
        columns: [
            { "data" : "ts_observation" , title:"Timestamp"},
            { "data" : "name", title:"Name"},
            { "data" : "feat_type", title:"Feature Type"},
            { "data" : "report", title:"Report narrative"}
        ],
        "columnDefs": [
		    { "width": "25%", "targets": 0 },
		    { "width": "25%", "targets": 1 },
		    { "width": "25%", "targets": 2 },
		    { "width": "25%", "targets": 3 }
		  ],
        "order": [[ 0, "desc" ],[2,"asc"]]
    });
});