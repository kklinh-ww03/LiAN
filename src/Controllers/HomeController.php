<?php

namespace App\Controllers;

use App\Controller;
use App\Models\Yard;

class homeController extends Controller
{
    private $YardModel;
    public function __construct()
    {
        $this->YardModel = new Yard();
    }

    public function index()
    {
        $Yards = $this->YardModel->getAllYards();
        $this->render('home\intro', ['Yards' => $Yards]);
    }
}
