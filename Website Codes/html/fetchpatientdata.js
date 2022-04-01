function view_data()
{
    var patient_id = document.getElementById("view_data").value;
    //alert("Patient Selected: " + patient_id);
    $.when(
        $.ajax({
            url:"phpfetchpatient.php",
            method:"POST",
            data:{
                id : patient_id
            },
            success:function(data){
                $("#display_data").html(data);
            }
        }),
        $.ajax({
            url:"phpfetchpatientmedical.php",
            method:"POST",
            data:{
                id : patient_id
            },
            success:function(data){
                $("#medicines_data").html(data);
            }
        })
    )
}

