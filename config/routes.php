<?php

  return array(
    '#^/$#' => 'Home/getHome',                                                   // GET запрос "Ключ это наш uri, значение это наш Controller и Method"
    '#^/gallery/$#' => 'Home/getGallery',
    '#^/contact/$#' => 'Home/getContact'
  );

?>
