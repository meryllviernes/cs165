let moms_data;

$(document).ready(function(){	
	console.log(sessionStorage);

    $("#observance_timestamp").datetimepicker({
        locale: "en",
        format: "YYYY-MM-DD HH:mm"
    });

    $("#moms_date").datetimepicker({
        locale: "en",
        format: "YYYY-MM-DD"
    });

    $("#submit_mom_date").click(function() {
        getMoms();
    })

    $("#submit_moms").on("click",function() {
        submitMoms();
    })

    $("#feature_type").on("change",function() {
        getFeatureName($("#feature_type").val());
    });

    $('#moms_table tbody').on('click','.update-moms',function(){
        var table = $('#moms_table').DataTable();
        moms_data = table.row($(this).closest('tr')).data();
        $("#update-moms-modal").modal("show");
    });

    $("#confirm_moms").on("click",function() {
        var update = {
            "reporter": moms_data.reporter,
            "moms_id": moms_data.moms_id,
            "narrative": $("#report_update_narrative").val()
        };
        console.log(update);
        $.post("../moms/update_moms", update)
        .done((data) => {
           if (data == "1") {
            alert("Update success!");
            location.reload();
           } else {
            alert("Update failed");
           }
        });
    });

    $("#delete_moms").on("click",function() {
        var delete_moms = {
            "moms_id": moms_data.moms_id
        }

        console.log(delete_moms);
        $.post("../moms/delete_moms", delete_moms).done((data) => {
           if (data == "1") {
            alert("Delete success!");
           } else {
            alert("Delete failed");
           }
        });
    });

    $('#moms_table tbody').on('click','.delete-moms',function(){
        var table = $('#moms_table').DataTable();
        moms_data = table.row($(this).closest('tr')).data();
        $("#delete-moms-modal").modal("show");
    });
});

function getFeatureName(feat_type) {
    let data = {
        "site_id": sessionStorage["site_id"],
        "feat_id": feat_type
    }

    $("#feature_name").empty();

    $.post("../moms/get_feature_name", data)
    .done((data) => {
       let result = JSON.parse(data);
       console.log(result);
       for (var counter = 0; counter < result.length; counter++) {
            $('<option>').val(result[counter].feat_id.toUpperCase()).text(result[counter].name.toUpperCase()).appendTo('#feature_name');
       }
    });
}

function getMoms() {
    let data = {
        "ts": $("#moms_date").val(),
        "site_id": sessionStorage['site_id']
    };

    let moms_table = $('#moms_table').DataTable( {
        "processing": true,
        "serverSide": true,
        "destroy": true,
        "ajax": {"url": '../moms/get_all_moms', "type": "POST","data": data},
        columns: [
            { "data" : "site_id" , title:"ID"},
            { "data" : "feat_type", title:"Feature type"},
            { "data" : "name", title:"Name"},
            { "data" : "observer", title:"Report narrative"},
            { "data" : "report", title:"Narrative"},
            { "data" : "functions", title: "*"}
        ],
    });
}

function submitMoms() {
    let data = {
        "feat_id": $("#feature_name").val(),
        "feat_type_id": $("#feature_type").val(),
        "observance_timestamp": $("#observance_timestamp").val(),
        "observer": $("#reported_by").val(),
        "user_id": sessionStorage['id'],
        "site_id": sessionStorage['site_id'],
        "narrative": $("#report_narative").val()
    }
    $.post("../moms/insert_moms", data).done((data) => {
        let result = data;
        if (result == "1") {
            alert("Successfully added Manifestation!");
        } else {
            alert("Failed to add Manifestation!");
        }
    }).fail( function(xhr, textStatus, errorThrown) {
        alert("Duplicate entry!");
    });
}