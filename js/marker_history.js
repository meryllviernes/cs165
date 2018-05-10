$(document).ready(function() {
	console.log(sessionStorage);

    $("#marker_observance_timestamp").datetimepicker({
        locale: "en",
        format: "YYYY-MM-DD HH:mm"
    }).on('dp.change', function (e) {
    	getMarkerHistoryNames();
    });

    $("#marker_history_save").on("click",function() {

      let data = {
        "ts": $("#marker_observance_timestamp").val(),
        "marker_id": $("#marker_name").val(),
        "event_id": $("#event").val()
      }

      checkExistingTS(data);

    });

    $("#event").on("change",function() {
      if ($("#event").val() == "3") {
        console.log("show");
        $("#new_marker_name_history").show();
      } else {
        console.log("hide");
        $("#new_marker_name_history").hide();
      }
    });

});

function getMarkerHistoryNames() {
	let data = {
		"site_id": sessionStorage['site_id'],
		"ts": $("#marker_observance_timestamp").val()
	};

  $("#marker_name").empty();
    $.post("../marker_history/get_marker_name", data)
    .done((data) => {
      console.log(data);
       let result = JSON.parse(data);
       for (var counter = 0; counter < result.length; counter++) {
            $('<option>').val(result[counter].marker_id).text(result[counter].name).appendTo('#marker_name');
       }
    });
}

function checkExistingTS(data) {
  let tsExists = {
    "ts": $("#marker_observance_timestamp").val(),
    "marker_id": $("#marker_name").val()
  }

  data.new_marker_name = $("#new_marker_name").val();

    $.post("../marker_history/check_marker_ts", tsExists)
    .done((result) => {
       let doesExist = JSON.parse(result);
       if (doesExist[0].status != 0) {
          alert("Duplicate entry!");
       } else {
          $.post("../marker_history/insert_marker_history",data).done((data) => {
              if (data == "1") {
                  alert("Insert success!");
                  // location.reload();
                } else {
                  alert("Insert failed");
                }
          });
       }
    });
}