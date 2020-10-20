<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$view = '';
$view .= '<div class="box box-default collapsed-box" id="addnewtask">
              <div class="box-header with-border">';
$view .= '<h4 onclick="addnewtask();"><a href="#"><b>Add New Task</b></a></h4>';
$view .= '<div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>';
$view .= '</div>';
$view .= '<div class="box-body">';
$view .= form_open('index.php/home/submitTask');

$view .= '<div class="form-group row">
                        <label for="name" class="col-12 col-sm-2 col-form-label text-sm-right">';
$view .= 'Task Name: <font color="red">*</font></label>
            <div class="col-12 col-sm-4 col-lg-4">
                <input required id="name" name="name" type="text" class="form-control" value="">
                <input id="type" name="type" type="hidden" value="Backlog">
            </div>';

$view .= '</div>';

$view .= '<div>
            <p class="text-right">
                <button type="submit" class="btn btn-space btn-primary">Submit</button>
                <button  type="button" onclick="location.href=\'index\';"  class="btn btn-space btn-secondary">Cancel</button>
            </p>
        </div>';

$view .= form_close();
$view .= '</div>';
$view .= '</div>';

$view .= '<div class="box box-default collapsed-box" id="updatetask">
              <div class="box-header with-border">';
$view .= '<h4 ><b>Update Task</b></h4>';
$view .= '<div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>';
$view .= '</div>';
$view .= '<div class="box-body">';
$attribute = array('id' => 'updatetaskform');
$view .= form_open('index.php/home/UpdateTask', $attribute);

$view .= '<div class="form-group row">
                        <label for="name" class="col-12 col-sm-2 col-form-label text-sm-right">';
$view .= 'Task Name:</label>
            <div class="col-12 col-sm-4 col-lg-4">
                <input id="task_name" name="task_name" type="text" class="form-control" value="" readonly>
                <input id="task_type" name="task_type" type="hidden" value="">
                <input id="task_id" name="task_id" type="hidden" value="">
            </div>';

$view .= '</div>';

$view .= '<div>
            <p class="text-right">

                <button  type="button" onclick="moveForwardTask();"  id= "forwardtask" class="btn btn-space btn-secondary">Move Forward</button>
                 <button  type="button" onclick="moveBackwardTask();"  id= "backwardtask" class="btn btn-space btn-secondary">Move Backward</button>
                 <button  type="button" onclick="removeTask();" class="btn btn-space btn-danger">Delete</button>
            </p>
        </div>';

$view .= form_close();
$view .= '</div>';
$view .= '</div>';

$view .= '<div class="box box-default">
              <div class="box-header with-border">';
$view .= '<h4><b>Kanban Board</b></h4>';
$view .= '<div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>';
$view .= '</div>';
$view .= '<div class="box-body" id="kanban">';

$view .= '</div>';
$view .= '</div>';
echo $view;
$js = <<<EQQ
<script>
$(document).ready(function () {
   $.ajax({
            type: 'POST',
            async: false,
            url: 'getTaskList',
            success: function(response) {
              $("#kanban").empty();
              $("#kanban").append(response);
            }
      });
});
function taskupdate(elem){
  $("#updatetask").removeClass("collapsed-box");
  $("#task_id").val($(elem).attr('id'));
  $("#task_name").val($(elem).attr('datavalue'));
  $("#task_type").val($(elem).attr('datatype'));
  if($(elem).attr('datatype') == 'Done'){
      $("#backwardtask").show();
      $("#forwardtask").hide();
    }else if($(elem).attr('datatype') == 'Backlog'){
      $("#forwardtask").show();
      $("#backwardtask").hide();
    }else{
      $("#forwardtask").show();
      $("#backwardtask").show();
    }
}
function removeTask(){
  var values = {};
    $.each($('#updatetaskform').serializeArray(), function (i, field) {
        values[field.name] = field.value;
    });
    var formdata  = JSON.stringify(values);
    if(confirm("Are you sure you want to delete this task?")){
      $.ajax({
            type: 'POST',
            data: {
              metadata : formdata,
            },
            async: false,
            url: 'removeTask',
            success: function(response) {
              alert("Task successfully deleted");
              $.ajax({
                    type: 'POST',
                    async: false,
                    url: 'getTaskList',
                    success: function(response) {
                      $("#kanban").empty();
                      $("#kanban").append(response);
                      $("#task_id").val('');
                      $("#task_name").val('');
                      $("#task_type").val('');
                      $("#forwardtask").show();
                      $("#backwardtask").show();
                    }
              });
            }
      });
  }

}
function moveForwardTask(){
  var values = {};
    $.each($('#updatetaskform').serializeArray(), function (i, field) {
        values[field.name] = field.value;
    });
    var formdata  = JSON.stringify(values);
      $.ajax({
            type: 'POST',
            data: {
              metadata : formdata,
            },
            async: false,
            url: 'moveForwardTask',
            success: function(response) {
              alert("Task successfully updated");
              $.ajax({
                    type: 'POST',
                    async: false,
                    url: 'getTaskList',
                    success: function(response) {
                      $("#kanban").empty();
                      $("#kanban").append(response);
                      $("#task_id").val('');
                      $("#task_name").val('');
                      $("#task_type").val('');
                      $("#forwardtask").show();
                      $("#backwardtask").show();
                    }
              });
            }
      });
}
function moveBackwardTask(){
  var values = {};
    $.each($('#updatetaskform').serializeArray(), function (i, field) {
        values[field.name] = field.value;
    });
    var formdata  = JSON.stringify(values);
      $.ajax({
            type: 'POST',
            data: {
              metadata : formdata,
            },
            async: false,
            url: 'moveBackwardTask',
            success: function(response) {
              alert("Task successfully updated");
              $.ajax({
                    type: 'POST',
                    async: false,
                    url: 'getTaskList',
                    success: function(response) {
                      $("#kanban").empty();
                      $("#kanban").append(response);
                      $("#task_id").val('');
                      $("#task_name").val('');
                      $("#task_type").val('');
                      $("#forwardtask").show();
                      $("#backwardtask").show();
                    }
              });
            }
      });
}
function addnewtask(){
    $("#addnewtask").removeClass("collapsed-box");
}

</script>

EQQ;
echo $js;
?>