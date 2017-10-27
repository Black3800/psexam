<?php

error_reporting(0);
require_once "../inc/check_register_inc.php";

$value = json_decode($_POST["value"]);
switch ($value->checkType)
{
  case "username":
    echo json_encode(["result"=>true]);
    break;

  case "password":
    if(strlen($value->value) >= 6)
    {
      echo json_encode(["result" => true]);
    }
    else
    {
      echo json_encode(["result" => false]);
    }
    break;

  case "passwordcheck":
    if($value->value1 === $value->value2)
    {
      echo json_encode(["result" => true]);
    }
    else
    {
      echo json_encode(["result" => false]);
    }
    break;

  case "realname":
    if(empty($value->value))
    {
      echo json_encode(["result" => false]);
    }
    else
    {
      echo json_encode(["result" => true]);
    }
    break;

  case "student_id";
    if(strlen(strval($value->value)) === 5)
    {
      echo json_encode(["result" => true]);
    }
    else
    {
      echo json_encode(["result" => false]);
    }
    break;

  case "account_type":
    if($value->value===1 || $value->value===2)
    {
      $result = ["result" => true];
      echo json_encode($result);
    }
    else
    {
      $result = ["result" => false];
      echo json_encode($result);
    }
    break;

  default:
    break;
}

 ?>
