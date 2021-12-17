<?php

class Emails extends Controller
{

    public function __construct()
    {
        $this->emailModel = $this->model('Email');
    }


    public function index()
    {
        //Variables 
        $outputData = '';
        $providers = '';
        $filterBy = array("sdate", "desc");
        $_SESSION['filterParams'] = 'sdatedesc';

        $urlQuery = $this->getQuery();
        if (!empty($urlQuery)) {

            if ((array_key_exists('filterby',$urlQuery)) && (!empty($urlQuery['filterby']))){
                $filterParams = $urlQuery['filterby'];
                $filterParam = htmlspecialchars(stripslashes(trim($filterParams)));
                $filterParams = str_split($filterParam, 5);
                $filterBy = $filterParams;
                $_SESSION['filterParams'] = $filterParam;
            }
            if ((array_key_exists('findEmail', $urlQuery)) && (!empty($urlQuery['findEmail']))) {
                $email = $urlQuery['findEmail'];
                $email = htmlspecialchars(stripslashes(trim($email)));
                $foundEmail = json_decode(json_encode($this->emailModel->findEmail($email, $filterBy)), true);
                $_SESSION['searchMail'] = $email;
                if($foundEmail == false){
                    return $outputData = [];
                } else {
                   $outputData = $foundEmail; 
                }
                
            }
            if ((array_key_exists('searchByDate', $urlQuery)) && (!empty($urlQuery['searchByDate']))) {
                $date = $urlQuery['searchByDate'];
                $date = htmlspecialchars(stripslashes(trim($date)));
                $searchRes = json_decode(json_encode($this->emailModel->searchByDate($date, $filterBy)), true);
                $_SESSION['searchDate'] = $date;
                if($searchRes == false){
                    return $outputData = null;
                } else {
                   $outputData = $searchRes; 
                }
                
            }
            if ((array_key_exists('mailProvider', $urlQuery)) && (!empty($urlQuery['mailProvider']))) {
                $mailProvider = $urlQuery['mailProvider'];
                $mailProvider = htmlspecialchars(stripslashes(trim($mailProvider)));
                $searchRes = json_decode(json_encode($this->emailModel->searchByProvider($mailProvider, $filterBy)), true);
                $_SESSION['selectedProvider'] = $mailProvider;
                $outputData = $searchRes;
            }

            if ((!empty($urlQuery['filterby'])) && (empty($urlQuery['mailProvider'])) && (empty($urlQuery['searchByDate'])) && (empty($urlQuery['findEmail']))) {
                $outputData = json_decode(json_encode($this->emailModel->allRecords($filterBy)), true);
                $providers = json_decode(json_encode($this->emailModel->emailProvider()), true);
            }
            

        } else {
            $outputData = json_decode(json_encode($this->emailModel->allRecords($filterBy)), true);
            $providers = json_decode(json_encode($this->emailModel->emailProvider()), true);
        }

        if (isset($_POST['delid'])) {
            $id = $_POST['delid'];
            $this->emailModel->deleteOne($id);
            header('Location:' . URLROOT . '/emails');
            die();
        }

        $data = [
            'output' => $outputData,
            'providers' => $providers,
            'filter' => $filterBy,
            'queryString' => $urlQuery
        ];

        $this->view('Emails/index', $data);
    }

    public function getQuery()
    {
        $array = explode('/', $_SERVER['QUERY_STRING']);
        if (empty($array[2])) {
            return false;
        } else {
            $queryString = parse_str($array[2], $output);
            return $output;
        }
    }
}
