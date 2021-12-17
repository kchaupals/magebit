<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <base href="<?php echo URLROOT; ?>">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/style/css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title><?php echo SITENAME; ?></title>
</head>

<body>
    <main>
        <header>
            <a href="#" class="home">
                <img class="pine-logo" src="<?php echo URLROOT; ?>/img/logo.svg" />
                <span class="pine-text"><?php echo SITENAME; ?></span>
            </a>
            <ul class="pine-nav">
                <li class="pine-navlink"><a class="link1" href="<?php echo URLROOT; ?>/#">About</a></li>
                <li class="pine-navlink">
                    <a class="link2" href="<?php echo URLROOT; ?>/#">How it works</a>
                </li>
                <li class="pine-navlink"><a class="link3" href="<?php echo URLROOT; ?>/#">Contact</a></li>
            </ul>
        </header>