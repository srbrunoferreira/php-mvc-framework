<?php

declare(strict_types=1);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

  <?php $this->add('head'); ?>

</head>

<body>

  <header id="mheader">

    <?php $this->add('header'); ?>

    <nav id="mnav">

      <?php $this->add('nav'); ?>

    </nav>

  </header>

  <main>

    <?php $this->add('main'); ?>

  </main>

  <footer id="mfooter">

    <?php $this->add('footer'); ?>

  </footer>

</body>

</html>