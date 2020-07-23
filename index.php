<?php
//this line makes PHP behave in a more strict way
declare(strict_types=1);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);


//we are going to use session variables so we need to enable sessions
session_start();

function whatIsHappening() {
    echo '<h2>$_GET</h2>';
    var_dump($_GET);
    echo '<h2>$_POST</h2>';
    var_dump($_POST);
    echo '<h2>$_COOKIE</h2>';
    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    var_dump($_SESSION);
}

//your products with their price.
$products = [
    ['name' => 'Club Ham', 'price' => 3.20],
    ['name' => 'Club Cheese', 'price' => 3],
    ['name' => 'Club Cheese & Ham', 'price' => 4],
    ['name' => 'Club Chicken', 'price' => 4],
    ['name' => 'Club Salmon', 'price' => 5]
];
if (isset($_GET['food']) && (int)$_GET['food'] ===0) {
    $products = [
        ['name' => 'Cola', 'price' => 2],
        ['name' => 'Fanta', 'price' => 2],
        ['name' => 'Sprite', 'price' => 2],
        ['name' => 'Ice-tea', 'price' => 3],
    ];
}

/**
 * Form validation
 */

// define variables and set to empty values
$emailErr = $streetErr =  $streetNumberErr = $cityErr = $zipcodeErr = "";
$email = $street = $streetNumber = $city = $zipcode = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);

        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    if (empty($_POST["street"])) {
        $streetErr = "Street name is required";
    } else {
        $street = test_input($_POST["street"]);

        // check if street only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/",$street)) {
            $streetErr = "Only letters and white space allowed";
        }
    }

    if (empty($_POST["streetNumber"])) {
        $streetNumberErr = "Street number is required";
    } else {
        $streetNumber = test_input($_POST["streetNumber"]);

        // check if streetNumber only contains letters and whitespace
        if (!preg_match("/^[0-9]*$/",$streetNumber)) {
            $streetNumberErr = "Only letters and white space allowed";
        }
        ;
    }

    if (empty($_POST["city"])) {
        $cityErr = "city is required";
    } else {
        $city = test_input($_POST["city"]);

        // check if city only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/",$city)) {
            $city = "Only letters and white space allowed";
        }

    }

    if (empty($_POST["zipcode"])) {
        $zipcodeErr = "zipcode is required";
    } else {
        $zipcode = test_input($_POST["zipcode"]);

        // check if zipcode only contains letters and whitespace
        if (!preg_match("/^[0-9]*$/",$zipcode)) {
            $zipcodeErr = "Only numbers allowed";
        }

    }
}

/**
 * input testing trim (whitespace and tabs).
 * strip lashes and html tags
 * @param $data
 * @return string
 */
function test_input($data) {
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


$totalValue = 0;

require 'formView.php';
