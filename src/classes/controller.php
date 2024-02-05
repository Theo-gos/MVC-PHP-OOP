<?php
abstract class Controller
{
    protected $request;
    protected $action;

    public function __construct($action, $request)
    {
        $this->action = $action;
    }

    public function executeAction()
    {
        return $this->{$this->action}();
    }

    protected function returnView($viewmodel, $fullview)
    {
        $view = 'src/views/' . get_class($this) . '/' . $this->action . '.php';
        if ($fullview) {
            require('src/views/main.php');
        } else {
            require($view);
        }
    }
}
