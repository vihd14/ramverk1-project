<!doctype html>
<html lang="sv">

<head>
    <meta charset="utf-8">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="<?= $this->di->get("url")->create("css/style.css") ?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
</head>
<body>
    <header class="site-header">
        <img src="<?= $this->di->get("url")->create("img/fagel2.png") ?>">
        <div class="header-text">
            <h1>The Home & Garden blog</h1>
            <p>How to create your dream environment</p>
        </div>
    </header>
    <main>
