function generate_data()
{
    var patient_id = document.getElementById("generate_data").value;
    //alert("Patient Selected: " + patient_id);
    $.ajax({
       url:"fpdfgenerate.php",
       method:"POST",
       data:{
            id : patient_id
        }
    })
}