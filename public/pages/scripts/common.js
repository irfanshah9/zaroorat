/*DELETE ELECTRICIAN*/
function delete_electrician(id){
bootbox.confirm("<h4>Confirmation!</h4>Are you sure to delete this Electrician?", function(result) {
if (result == true) {
$.ajax({
type: "DELETE",
data: {"id": id, token: "{{ csrf_token() }}", method: 'DELETE'},
url: "../electrician/"+id,
dataType: "json",
success: function(response) {
location.reload();
return false;
}
});
}
});
}