<?php

class Users extends Controller
{
    public function login()
    {
        $viewmodel = new UserModel();
        $this->returnView($viewmodel->login(), true);
    }

    public function logout()
    {
        $model = new UserModel();
        $model->logout();
    }

    public function register()
    {
        $viewmodel = new UserModel();
        $this->returnView($viewmodel->register(), true);
    }
}
