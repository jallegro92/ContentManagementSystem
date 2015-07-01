<?php
require 'classes/DbAccessor.php';
require 'classes/Page.php';
require_once 'build/index.php';
if (isset($_GET['page'])){
    $getPageID = $_GET['page'];
} else {
    $getPageID = 0;
}