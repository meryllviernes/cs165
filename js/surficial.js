let surficial_data;
$(document).ready(function(){	
	disableCommands();
    $("#observance_timestamp").datetimepicker({
        locale: "en",
        format: "YYYY-MM-DD HH:mm"
    }).on('dp.change', function (e) {
    	loadMarkers();
    });;

    $("#surficial_date").datetimepicker({
    	locale: "en",
    	format: "YYYY-MM-DD"
    });

    $("#surficial_save").click(function() {
    	submitMarkerMeas();
    });

    $("#submit_surficial_date").click(function() {
    	getSurficial();
    });

    $('#surficial_table tbody').on('click','.update-surficial',function(){
        var table = $('#surficial_table').DataTable();
        surficial_data = table.row($(this).closest('tr')).data();
        $("#update-surficial-modal").modal("show");
    });

    $("#confirm_surficial").on("click",function() {

    let data = {
    	"new_meas": $("#surficial_meas").val(),
    	"data_id": surficial_data.data_id,
    	"user_id": sessionStorage['id'],
    	"mo_id": surficial_data.mo_id
    };

    	$.post("../surficial/update_surficial",data)
	    .done((data) => {
           if (data == "1") {
            alert("Update success!");
            location.reload();
           } else {
            alert("Update failed");
           }
    	});
	});

    $("#delete_surficial").on("click",function() {
	    let data = {
	    	"data_id": surficial_data.data_id,
	    	"user_id": sessionStorage['id'],
	    	"mo_id": surficial_data.mo_id
	    };

	    $.post("../surficial/delete_surficial",data)
	    .done((data) => {
           if (data == "1") {
            alert("Delete success!");
            location.reload();
           } else {
            alert("Delete failed");
           }
    	});
    });

    $('#surficial_table tbody').on('click','.delete-surficial',function(){
        var table = $('#surficial_table').DataTable();
        surficial_data = table.row($(this).closest('tr')).data();
        $("#delete-surficial-modal").modal("show");
    });


});


function loadMarkers() {
	console.log($("#observance_timestamp").val());
	let tsExist = {
		"site_id": sessionStorage['site_id'],
		"ts": $("#observance_timestamp").val()+":00"
	}
  
	$.post("../surficial/check_ts_surficial", tsExist)
    .done((result) => {
       let doesExist = JSON.parse(result);
       if (doesExist.length != 0) {
          alert("Duplicate entry!");
          disableCommands();
       } else {
          enableCommands();
       		getMarkerNames();
          getWeather();
       }
    });
}

function disableCommands() {
  $("#surficial_event_optradio").prop( "disabled", true );
  $("#surficial_observer").prop( "disabled", true );
  $("#marker_name").prop( "disabled", true );
  $("#weather").prop( "disabled", true );
  $("#marker_measurement").prop( "disabled", true );
  $("#surficial_save").prop( "disabled", true );
}

function enableCommands(){
  $("#surficial_event_optradio").prop( "disabled", false );
  $("#surficial_observer").prop( "disabled", false );
  $("#marker_name").prop( "disabled", false );
  $("#weather").prop( "disabled", false );
  $("#marker_measurement").prop( "disabled", false );
  $("#surficial_save").prop( "disabled", false );
}

function getMarkerNames() {
    let data = {
        "site_id": sessionStorage['site_id']
    }
    $("#marker_name").empty();
    $.post("../surficial/get_marker_name", data).done((data) => {
        console.log(data);
       let result = JSON.parse(data);
       for (var counter = 0; counter < result.length; counter++) {
            $('<option>').val(result[counter].marker_id.toUpperCase()).text(result[counter].name.toUpperCase()).appendTo('#marker_name');
       }
    });
}

function getWeather() {
  $("#weather").empty();
    $.get("../surficial/get_weather", (data) => {
        console.log(data);
       let result = JSON.parse(data);
       for (var counter = 0; counter < result.length; counter++) {
            $('<option>').val(result[counter].weather_id.toUpperCase()).text(result[counter].name.toUpperCase()).appendTo('#weather');
       }
    });
}

function submitMarkerMeas() {
	let data = {
		"ts": $("#observance_timestamp").val()+":00",
		"site_id": sessionStorage["site_id"],
		"observer": $("#surficial_observer").val(),
		"meas_event": $("input[name='surficial_event_optradio']:checked").val(),
		"marker_id": $("#marker_name").val(),
		"weather_id": $("#weather").val(),
		"marker_measurement": $("#marker_measurement").val(),
		"sender": sessionStorage["id"]
	}
	
	$.post("../surficial/add_surficial_meas", data).done((data) => {
    console.log(data);
		if (data == "true") {
      alert("Update success!");
      location.reload();
     } else {
      alert("Update failed");
     }
	});
}


function getSurficial() {

	let data = {
		"ts": $("#surficial_date").val(),
    "site_id": sessionStorage['site_id']
	};

  console.log(data);
    let surificial_table = $('#surficial_table').DataTable( {
        "processing": true,
        "serverSide": true,
        "destroy": true,
        "ajax": {"url": '../surficial/get_all_surficial', "type": "POST", "data": data},
        columns: [
            { "data" : "marker_id" , title:"ID#", "visible": false},
            { "data" : "data_id", "visible": false},
            { "data" : "mo_id", "visible": false},
            { "data" : "meas", title:"Measurement"},
            { "data" : "name", title:"Name"},
            { "data" : "ts", title: "Timestamp"},
            { "data" : "functions", title:"Functions"}
        ],
    });
}

