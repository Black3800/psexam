<?php

define("navbar_nav_all_exam", 1, true);
define("navbar_nav_my_exam", 2, true);
define("navbar_nav_create_exam", 3, true);
define("navbar_nav_input_score", 4, true);

function output_navbar_nav($navConst)
{
  switch($navConst)
  {
    case navbar_nav_all_exam:
      echo '<li id="navbar_nav_all_exam">All exams<i class="glyphicon glyphicon-eye-open"></i></li>';
      break;
    case navbar_nav_my_exam:
      echo '<li id="navbar_nav_my_exam">My exam<i class="glyphicon glyphicon-file"></i></li>';
      break;
    case navbar_nav_create_exam:
      echo '<li id="navbar_nav_create_exam">New exam<i class="glyphicon glyphicon-plus-sign"></i></li>';
      break;
    case navbar_nav_input_score:
      echo '<li id="navbar_nav_input_score">Input score<i class="glyphicon glyphicon-pencil"></i></li>';
      break;

    default:
      break;
  }
}

 ?>
