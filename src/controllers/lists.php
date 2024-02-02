<?php
class Lists extends Controller
{
    protected function index()
    {
        $viewmodel = new ListModel();
        $this->returnView($viewmodel->index(), true);
    }

    protected function add()
    {
        $viewmodel = new ListModel();
        $this->returnView($viewmodel->add(), true);
    }

    protected function edit()
    {
        $viewmodel = new ListModel();
        $this->returnView($viewmodel->edit(), true);
    }

    protected function delete()
    {
        $viewmodel = new ListModel();
        $this->returnView($viewmodel->delete(), true);
    }
}
