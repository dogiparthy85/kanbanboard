<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$view = '';
$view .= '<div class="box box-default collapsed-box">
              <div class="box-header with-border">';
$view .= '<h4><b>New Task</b></h4>';
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

$view .= '<div class="box box-default collapsed-box">
              <div class="box-header with-border">';
$view .= '<h4><b>Update Task</b></h4>';
$view .= '<div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>';
$view .= '</div>';
$view .= '<div class="box-body">';
$view .= form_open('index.php/home/UpdateTask');

$view .= '<div class="form-group row">
                        <label for="name" class="col-12 col-sm-2 col-form-label text-sm-right">';
$view .= 'Task Name:</label>
            <div class="col-12 col-sm-4 col-lg-4">
                <input id="name" name="name" type="text" class="form-control" value="" readonly>
                <input id="type" name="type" type="hidden" value="">
                <input id="task_id" name="task_id" type="hidden" value="">
            </div>';

$view .= '</div>';

$view .= '<div>
            <p class="text-right">
                <button  type="button" onclick="location.href=\'removeTask\';"  class="btn btn-space btn-danger">Delete</button>
                <button  type="button" onclick="location.href=\'moveForwardTask\';"  class="btn btn-space btn-secondary">Move Forward</button>
                 <button  type="button" onclick="location.href=\'moveBackwardTask\';"  class="btn btn-space btn-secondary">Move Backward</button>
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
$view .= '<div class="box-body" id="kanban" width="auto" height="auto"> ';

$view .= '</div>';
$view .= '</div>';
echo $view;
$js = <<<EQQ
<script>
$(document).ready(function () {
	 var fields = [
                     { name: "id", type: "string" },
                     { name: "type", map: "type", type: "string" },
                     { name: "name", map: "name", type: "string" },
      ];
	var source ={
        datatype: "json",
        datafields: fields,
        url: 'getTaskList',
        async: true
    };
    var dataAdapter = new $.jqx.dataAdapter(source);
    var resourcesAdapterFunc = function () {
                var resourcesSource =
                {
                    localData: [
                          { id: 0, name: "No name", image: "", common: true },
                          { id: 1, name: "Andrew Fuller", image: "" },
                          { id: 2, name: "Janet Leverling", image: "" },
                          { id: 3, name: "Steven Buchanan", image: "" },
                          { id: 4, name: "Nancy Davolio", image: "" },
                          { id: 5, name: "Michael Buchanan", image: "" },
                          { id: 6, name: "Margaret Buchanan", image: "" },
                          { id: 7, name: "Robert Buchanan", image: "" },
                          { id: 8, name: "Laura Buchanan", image: "" },
                          { id: 9, name: "Laura Buchanan", image: "" }
                    ],
                    dataType: "array",
                    dataFields: [
                         { name: "id", type: "number" },
                         { name: "name", type: "string" },
                         { name: "image", type: "string" },
                         { name: "common", type: "boolean" }
                    ]
                };
                var resourcesDataAdapter = new $.jqx.dataAdapter(resourcesSource);
                return resourcesDataAdapter;
            }

    $("#kanban").jqxKanban({
    	resources: resourcesAdapterFunc(),
        source: dataAdapter,
        theme: 'classic',
         columns: [
                    { text: "Backlog", dataField: "Backlog" },
                    { text: "To Do", dataField: "To Do" },
                    { text: "Ongoing", dataField: "Ongoing" },
                    { text: "Done", dataField: "Done" }
                ]
    });
/*
	 $.ajax({
            type: 'POST',
            async: false,
            url: 'getTaskList',
            dataType: 'json',
            success: function(response) {
                $("#kanban).empty();
                $.each(response, function(key, data) {
                    $("#kanban).append('<option value="'+data.Field+'">'+data.Field+'</option>');
                });
            }
         });
*/
});

</script>

EQQ;
echo $js;
?>