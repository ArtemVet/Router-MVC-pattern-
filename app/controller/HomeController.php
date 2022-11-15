<?php

namespace app\controller;

class HomeController
{

  public function getHomeAction() {

    include '../app/view/layout/header.php';
    include '../app/view/home.php';
    include '../app/view/layout/footer.php';

  }

  public function getGalleryAction() {

    include '../app/view/layout/header.php';
    include '../app/view/gallery.php';
    include '../app/view/layout/footer.php';

  }

  public function getContactAction() {

    include '../app/view/layout/header.php';
    include '../app/view/contact.php';
    include '../app/view/layout/footer.php';

  }

}

?>
