<?php

namespace App\Controllers;

use App\Models\Yard;
use App\Controller;

class YardController extends Controller
{
    private $YardModel;

    public function __construct()
    {
        $this->YardModel = new Yard();
        $this->startSession();
    }

    private function startSession()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // public function delete($YardId)
    // {
    //     $this->ensureLoggedIn();
    //     $this->YardModel->deleteYard($YardId);
    //     header('Location: /Yard/list');
    // }

    public function ensureLoggedIn()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['currentUser'])) {
            header('Location: /user/signin');
            exit();
        }
    }
    public function details($YardId)
    {
        $this->ensureLoggedIn(); 
        $Yard = $this->YardModel->getYardById($YardId);
        if ($Yard) {
            $this->render('Yards\Yard-details', ['Yard' => $Yard]);
        } else {
            echo "<h2 class='text-center text-danger'>Sân không tồn tại.</h2>";
    }
    }


}
