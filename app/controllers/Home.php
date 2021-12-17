<?php
class Home extends Controller
{
    public function __construct()
    {
        $this->subModel = $this->model('Homes');
    }
    public function index()
    {

        //variables 
        $msg = [];
        $valid = false;
        $data = [];

        $reqMethod = strtoupper($_SERVER['REQUEST_METHOD']);

        if ($reqMethod == 'POST' && isset($_POST['submit'])) {
            session_start();
            // Variables
            $emailRegex = "/^[\wp{-}\.0-9]+@{1}([\w-])+\.+[\w]{2,4}$/i";
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $input_data = trim($_POST['email']);
            if ($input_data === '') {
                $msg = 'Field can\'t be empty';
            } else if (!preg_match($emailRegex, $input_data)) {
                $msg = 'Enter correct mail';
            } else if (explode('.', $input_data)[count(explode('.', $input_data)) - 1] == 'co') {
                $msg = 'We are not accepting subscriptions from Colombia emails';
            } else if (!isset($_POST['checkbox'])) {
                $msg = 'You must accept to terms & conditions';
            } else {
                if ($this->subModel->subscribe($input_data)) {
                    $valid = true;
                    $msg = '';
                } else {
                    die('Database error');
                    $msg = 'Database error';
                }
            }
            $_SESSION['valid'] = $valid;
            $_SESSION['error'] = $msg;
            header('Location:' . URLROOT . '/', true, 302);
            exit();
        }

        $this->view('index', $data);
    }
}
