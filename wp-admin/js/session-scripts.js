function delete_row(del_id) {
    console.log("dhuksi")
    if (confirm("Are you sure you want to delete this contact?")) {
        // html row
        const row = document.getElementById("delete-"+del_id);
        console.log("delete"+del_id)
        row.parentNode.removeChild(row);

        // from database
        // const value = ("#delete-"+del_id).val();
        // console.log(value)
    }
    console.log('jacchi')
}
// MySql.Execute(
//     "localhost",
//     "root",
//     "nascenia",
//     "worpress",
//     "select * from wp_sessions",
//     function (data) {
//         console.log(data)
//     });

// const delete_button = document.getElementsByClassName("delete");
// console.log(delete_button)
//
// delete_button.addEventListener("click",(e)=>{
//     // console.log($(this).attr('id'));
//     console.log("clicked", e)
// })
// // delete_button.style.color = "red";
// console.log("hi")

