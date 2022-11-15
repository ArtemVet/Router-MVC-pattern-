<?php

  namespace router;                                                             // Объявляем пространство имен

  class Router                                                                  // Объявляем наш класс Router
  {

    public static function uri($uri, $method) {                                 // Объявляем нашу функцию uri и прописываем в ней инструкции

      $routes = include '../config/routes.php';                                 // Подключаем наши роуты
      $existsUri = FALSE;
      $controller;

      if($method == 'GET') {                                                    // Если используется метод GET то выполняем следующие инструкции
        if($pos = strpos($uri, '?')){                                           // Проверяем строку uri на наличие GET параметров при помощи метода strpos()
          $uri = substr($uri, 0, $pos);                                         // Если GET параметры присутствуют то отбрасываем их при помощи метода substr()
        }

        foreach($routes as $patternURI => $patternController) {                 // Проходимся по нашим роутам циклом foreach
          if(preg_match($patternURI, $uri)){                                    // При помощи метода preg_match() сравниваем наши шаблоны uri с запрашиваемым uri
            $existsUri = TRUE;                                                  // При совпадении шаблона uri с запрашиваемым uri, присваиваем значение TRUE нашей переменной $existsUri
            $controller = $patternController;                                   // Присваиваем нашей переменной $controller значение из переменной $patternController
            break;                                                              // При помощи оператора break прерываем наш цикл
          }
        }

        if($existsUri) {                                                        // Если запрашиваемый uri есть в наших роутах то выполняем следующие инструкции
          $segments = explode('/', $controller);                                // Объявляем переменную segments. При помощи метода explode() мы преобразовываем нашу строку в массив "Тем самым разбивая наше значение строки на класс и метод"
          $controllerName = $segments[0].'Controller';                          // Переменной $controllerName  присваиваем значение из 0 ключа нашего массива и применяем конкатенацию со строкой "Controller"
          $methodName = $segments[1].'Action';                                  // Переменной $methodName  присваиваем значение из 1 ключа нашего массива и применяем конкатенацию со строкой "Action"
          $path = '../app/controller/'.$controllerName.'.php';                  // Объявляем переменную $path и присваиваем путь к нашему файлу

          if(file_exists($path)) {                                              // При помощи метода file_exists() проверяем существование нашего файла

            $controllerName = 'app\controller\\'.$controllerName;               // В переменную с именем нашего контроллера мы добавляем пространство имен
            $controller = new $controllerName;                                  // Создаем экземпляр класса

            if(method_exists($controller, $methodName)) {                       // При помощи метода method_exists() проверяем существование вызываемого метода в нашем экземпляре класса
              $controller->$methodName();                                       // Вызываем наш метод
            }
          } else {
            header('Location: / ');                                             // Если uri не найден то отправляем заголовок на возврат пользователя на главную страницу нашего сайта
          }
        }
      }
    }

  }

?>
