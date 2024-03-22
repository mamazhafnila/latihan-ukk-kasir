<?php

require('functions.php');

if (isset($_SESSION['login'])) {
    //yaudah masuk
} else {
    header('location:login.php');
}