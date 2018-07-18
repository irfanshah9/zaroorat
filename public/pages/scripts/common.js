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
/*DELETE Plumber*/
function delete_plumber(id){
bootbox.confirm("<h4>Confirmation!</h4>Are you sure to delete this plumber?", function(result) {
if (result == true) {
$.ajax({
type: "DELETE",
data: {"id": id, token: "{{ csrf_token() }}", method: 'DELETE'},
url: "../plumber/"+id,
dataType: "json",
success: function(response) {
location.reload();
return false;
}
});
}
});
}
/*DELETE Painter*/
function delete_painter(id){
bootbox.confirm("<h4>Confirmation!</h4>Are you sure to delete this Painter?", function(result) {
if (result == true) {
$.ajax({
type: "DELETE",
data: {"id": id, token: "{{ csrf_token() }}", method: 'DELETE'},
url: "../painter/"+id,
dataType: "json",
success: function(response) {
location.reload();
return false;
}
});
}
});
}
/*DELETE Car Painter*/
function delete_carpainter(id){
bootbox.confirm("<h4>Confirmation!</h4>Are you sure to delete this Car Painter?", function(result) {
if (result == true) {
$.ajax({
type: "DELETE",
data: {"id": id, token: "{{ csrf_token() }}", method: 'DELETE'},
url: "../carpainter/"+id,
dataType: "json",
success: function(response) {
location.reload();
return false;
}
});
}
});
}
/*DELETE Mason*/
function delete_mason(id){
bootbox.confirm("<h4>Confirmation!</h4>Are you sure to delete this Mason?", function(result) {
if (result == true) {
$.ajax({
type: "DELETE",
data: {"id": id, token: "{{ csrf_token() }}", method: 'DELETE'},
url: "../mason/"+id,
dataType: "json",
success: function(response) {
location.reload();
return false;
}
});
}
});
}
/*DELETE Labour*/
function delete_labour(id){
bootbox.confirm("<h4>Confirmation!</h4>Are you sure to delete this Labour?", function(result) {
if (result == true) {
$.ajax({
type: "DELETE",
data: {"id": id, token: "{{ csrf_token() }}", method: 'DELETE'},
url: "../labour/"+id,
dataType: "json",
success: function(response) {
location.reload();
return false;
}
});
}
});
}
