<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$arrayJson = file_get_contents(APPPATH . 'config/cstmconfigMenuJson.json');

$view = '';
$view .= '<div class="box box-default">';
$view .= '<div class="box-body">';
$view .= '<div class="row">
   <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 co-12">
      <div class="box box-default">
      <div class="box-header with-border">';
$view .= '<h4><b>Sidebar Menu</b> </h4> </div>
       <div class="box-body">
            <button id="btnReload" type="button" class="btn btn-outline-secondary"><i class="fa fa-play"></i>Load Data</button>
            <button id="btnSave" type="button" class="btn btn-outline-primary">Save Menu Data</button>
        </div>
         <div class="dd" id="nestable">
            <ul id="myEditor" class="sortableLists list-group">
            </ul>
         </div>
     </div>
   </div>
   <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 co-12">
     <div class="box box-default">
           <div class="box-header with-border">';
$view .= '<h4><b>Edit Item</b> </h4></div>
         <div class="box-body">
            <form id="frmEdit">
                <div class="form-group">
                    <label for="inputText">Text</label>
                    <div class="input-group">
                        <input id="text" name="text" type="text" class="form-control item-menu">
                       <span class="input-group-btn">
                            <button type="button" id="myEditor_icon" class="btn btn-info btn-flat"></button>
                        </span>
                        </div>
                        <input type="hidden" name="icon" class="item-menu">
                </div>
                <div class="form-group">
                    <label for="inputURL">URL</label>
                    <input id="href" name="href" type="text" class="form-control item-menu">
                </div>
                <div class="form-group">
                    <label for="inputTarget">Traget</label>
                    <select class="form-control item-menu" id="target" name="target">
                        <option value="_self">Self</option>
                        <option value="_blank">Blank</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="inputTooltip">Tooltip</label>
                    <input id="title" name="title" type="text" class="form-control item-menu">
                </div>
                <div class="form-group">
                    <button type="button" id="btnUpdate" class="btn btn-primary" disabled><i class="fas fa-sync-alt"></i> Update</button>
                    <button type="button" id="btnAdd" class="btn btn-success"><i class="fa fa-plus"></i> Add</button>
                </div>
            </form>
         </div>
      </div>
         </div>
</div>
   </div>
</div>';
$view .= <<<EQQ
    <script>
            $(document).ready(function () {
                var arrayjson = $arrayJson;
                /* =============== DEMO =============== */
                // menu items
                // icon picker options
                var iconPickerOptions = {searchText: "Buscar...", labelHeader: "{0}/{1}"};
                var sortableListOptions = {
                    placeholderCss: {'background-color': "#cccccc"}
                };

                var editor = new MenuEditor('myEditor', {listOptions: sortableListOptions, iconPicker: iconPickerOptions});
                editor.setForm($('#frmEdit'));
                editor.setUpdateButton($('#btnUpdate'));
                $('#btnReload').on('click', function () {
                    editor.setData(arrayjson);
                    if ($('#myEditor li').length == 0){
                        $("#btnSave").hide();
                    }
                    else{
                        $("#btnSave").show();
                    }
                });

                $('#btnOutput').on('click', function () {
                    var str = editor.getString();
                    $("#out").text(str);
                });

                $("#btnUpdate").click(function(){
                    editor.update();
                });
                 $("#btnSave").click(function(){
                    var str = editor.getString();
                    saveMenuChanges(str);
                });

                $('#btnAdd').click(function(){
                    editor.add();
                });
                if ($('#myEditor li').length == 0){
                    $("#btnSave").hide();
                }
                else{
                 $("#btnSave").show();
                }
                /* ====================================== */

                /** PAGE ELEMENTS **/
              //  $('[data-toggle="tooltip"]').tooltip();
                $.getJSON( "https://api.github.com/repos/davicotico/jQuery-Menu-Editor", function( data ) {
                    $('#btnStars').html(data.stargazers_count);
                    $('#btnForks').html(data.forks_count);
                });
            });
            function saveMenuChanges(str){
                $.ajax({
                    type: 'POST',
                    data: {
                        'jsonmenu': str,
                    },
                    async: false,
                    url: 'saveMenuChanges',
                    success: function(data) {
                        if(data){
                        alert("Your menu successfully updated");
                        window.location.href ='index';
                        }else{
                            alert("Your menu successfully not updated");
                        }
                    }
                });
            }
        </script>
EQQ;
echo $view;
