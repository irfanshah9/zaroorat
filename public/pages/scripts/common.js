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
/*DELETE AC Mechanic*/
function delete_ac_mechanic(id){
bootbox.confirm("<h4>Confirmation!</h4>Are you sure to delete this Mechanic?", function(result) {
if (result == true) {
$.ajax({
type: "DELETE",
data: {"id": id, token: "{{ csrf_token() }}", method: 'DELETE'},
url: "../ac_mechanic/"+id,
dataType: "json",
success: function(response) {
location.reload();
return false;
}
});
}
});
}
/*DELETE CAR Mechanic*/
function delete_car_mechanic(id){
bootbox.confirm("<h4>Confirmation!</h4>Are you sure to delete this Car Mechanic?", function(result) {
if (result == true) {
$.ajax({
type: "DELETE",
data: {"id": id, token: "{{ csrf_token() }}", method: 'DELETE'},
url: "../car_mechanic/"+id,
dataType: "json",
success: function(response) {
location.reload();
return false;
}
});
}
});
}
/*DELETE CAR Mechanic*/
function delete_bike_mechanic(id){
bootbox.confirm("<h4>Confirmation!</h4>Are you sure to delete this Bike Mechanic?", function(result) {
if (result == true) {
$.ajax({
type: "DELETE",
data: {"id": id, token: "{{ csrf_token() }}", method: 'DELETE'},
url: "../bike_mechanic/"+id,
dataType: "json",
success: function(response) {
location.reload();
return false;
}
});
}
});
}
/*DELETE Gas Mechanic*/
function delete_gas_mechanic(id){
bootbox.confirm("<h4>Confirmation!</h4>Are you sure to delete this Gas Mechanic?", function(result) {
if (result == true) {
$.ajax({
type: "DELETE",
data: {"id": id, token: "{{ csrf_token() }}", method: 'DELETE'},
url: "../gas_mechanic/"+id,
dataType: "json",
success: function(response) {
location.reload();
return false;
}
});
}
});
}
/*DELETE Lock MAster*/
function delete_lock_master(id){
bootbox.confirm("<h4>Confirmation!</h4>Are you sure to delete this Lock Master?", function(result) {
if (result == true) {
$.ajax({
type: "DELETE",
data: {"id": id, token: "{{ csrf_token() }}", method: 'DELETE'},
url: "../lock_master/"+id,
dataType: "json",
success: function(response) {
location.reload();
return false;
}
});
}
});
}
