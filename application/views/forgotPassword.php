<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$view = '';
$view .= form_open('index.php/home/resetPassword');
$view .= '<div class="form-group has-feedback">
        <input type="text" class="form-control" name="username" id="username"  placeholder="Username" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="row">
         <div class="col-xs-6">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Reset Password</button>
        </div>
      </div>';
$view .= form_close();
$view .= '<br><br>
<div class="row">
    <div class="col-xs-6">
        <a href="login"  class="btn btn-lg btn-green btn-block">LOGIN</a>
    </div>
</div>'; 
echo $view;
