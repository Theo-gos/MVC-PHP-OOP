<?php
class HomeModel extends Model
{
    public function index()
    {
        $this->isUserLoggedIn();
        return;
    }
}
