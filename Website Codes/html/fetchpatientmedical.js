function view_data()
{
    var patient_id = document.getElementById("view_data").value;
    //alert("Patient Selected: " + patient_id);
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
}
