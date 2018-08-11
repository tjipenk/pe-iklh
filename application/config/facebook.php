<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
|  Facebook App details
| -------------------------------------------------------------------
|
| To get an facebook app details you have to be a registered developer
| at http://developer.facebook.com and create an app for your project.
|
|  facebook_app_id               string  Your facebook app ID.
|  facebook_app_secret           string  Your facebook app secret.
|  facebook_login_type           string  Set login type. (web, js, canvas)
|  facebook_login_redirect_url   string  URL tor redirect back to after login. Do not include domain.
|  facebook_logout_redirect_url  string  URL tor redirect back to after login. Do not include domain.
|  facebook_permissions          array   The permissions you need.
*/

$config['facebook']['api_id']       = '477025902501524';
$config['facebook']['app_secret']   = 'c0f52ee7cf20957dc3dafc9a4993f499';
$config['facebook']['redirect_url'] = 'http://inovasi.inovasiuntukindonesia.org/';
$config['facebook']['permissions']  = array('email','user_location');

$config['api_id'] = $config['facebook']['api_id'];
$config['app_secret'] = $config['facebook']['app_secret'];