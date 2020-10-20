<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$view = '';
$view .= form_open('index.php/home/dologin');
     $view .= '<fieldset>
                <div class="form-group has-feedback">
                    <input class="form-control" placeholder="Email address/User Name"  name="username" type="text" required>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>                
                </div>
                <div class="form-group has-feedback">
                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>

                     <div id="remember-me-wrapper">
                            <div class="row">
                                    <div class="col-xs-6">
                                        <div class="portlet portlet-green">
                                                <div class="login-banner text-center">
                                                    <input type="checkbox" id="remember-me" checked="checked">
                                                    <label for="remember-me">Remember me</label>
                                                </div> 
                                        </div>
                                    </div>

                                    <div class="col-xs-6">
                                        <div class="portlet portlet-green">
                                                <div class="login-banner text-center">
                                                        <a href="forgotPassword" id="login-forget-link">
                                                       <label for="Forgot password?">Forgot password? </label> 
                                                        </a>
                                                 </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
<div class="row">
    <div class="col-xs-12">
        <button  class="btn btn-lg btn-green btn-block" type="submit">LOGIN</button>
    </div>
</div> 
<br>

</fieldset>
            <br>';

$view .= form_close();

echo $view;
