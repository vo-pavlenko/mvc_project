<?php
	/**
	 * 
	 */
	class Router {
		
		private $routes;

		function __construct() {
			//Записываем маршруты
			$routesPath = ROOT.'/config/routes.php';
			$this->routes = include( $routesPath );
		}
		/*
		* @return string
		*/
		private function getURI() {
			if ( !empty( $_SERVER['REQUEST_URI'] ) ) {

				return trim($_SERVER['REQUEST_URI'], '/');
			}
		}

		public function run() {
		//Получаем строку запроса
			$uri = $this->getURI();

			//Проверка наличия запроса
			foreach ( $this->routes as $uriPattern => $path ) {

				if (preg_match("~$uriPattern~", $uri)) {
					
					//Получаем внутренний путь
					$internalRoute = preg_replace("~$uriPattern~", $path, $uri);
					 
					//Определяем какой контроллер и action будет обрабатывать запрос
					$segments = explode('/', $internalRoute);

					$controllerName = ucfirst(array_shift($segments).'Controller');
					$actionName = 'action'.ucfirst(array_shift($segments));

					$parameters = $segments;

					//Подключить файл класса-контроллера
					$controllerFile = ROOT.'/controllers/'.$controllerName.'.php';

					if (file_exists($controllerFile)) {
						include_once ($controllerFile);
					}

					//Создаем объект, вызываем action
					$controllerObject = new $controllerName;

					$result = call_user_func_array(array($controllerObject, $actionName), $parameters);

					if ($result != null) {
						break;
					}
				}
			}
		}
	}
?>