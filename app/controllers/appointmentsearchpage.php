<?php
class Appointmentsearchpage extends Controller
{
    public function index($a = '', $b = '', $c = '')
    {
        $this->view('header');

        $doctor = new DoctorModel();
        $hospital = new Hospital();
        $specializations = $doctor->getSpecializations();
        $hospitals = $hospital->findAll();
        $doctorNames = $doctor->getAll();
        
      

        $nameQuery = "";
        $hospitalQuery = "";
        $specializationQuery = "";
        $dateQuery = "";
        $error = false;
        $doctorResults = null;

        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['submit'])) {
            if ($_GET['submit'] === 'reset') {
                $resetUrl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
                header("Location: $resetUrl");
            } else {
                $nameQuery = $_GET['doctor'] ?? '';
                $hospitalQuery = $_GET['hospital'] ?? '';
                $specializationQuery = $_GET['specialization'] ?? '';
                $dateQuery = $_GET['date'] ?? '';

                if (empty($nameQuery) && empty($hospitalQuery) && empty($specializationQuery) && empty($dateQuery)) {
                    $error = true;
                } else {
                    $doctorResults = $doctor->search($nameQuery, $hospitalQuery, $specializationQuery, $dateQuery);
                }
            }
        }
        
        $limit = 8;
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $currentPage = $currentPage < 1 ? 1 : $currentPage;

        $totalPages = 1;

        if (!$error && $doctorResults !== null) {
            $totalResults = count($doctorResults);
            $totalPages = ceil($totalResults / $limit);
            $offset = ($currentPage - 1) * $limit;
            $doctorResults = array_slice($doctorResults, $offset, $limit);
        }
        $data = [
            'doctorResults' => $doctorResults,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
            'totalResults' => $totalResults,
            'hospitals' => $hospitals,
            'specializations' => $specializations,
            'nameQuery' => $nameQuery,
            'hospitalQuery' => $hospitalQuery,
            'specializationQuery' => $specializationQuery,
            'dateQuery' => $dateQuery,
            'error' => $error,
            'doctorNames' => $doctorNames
        ];

        //currently empty queries are  $hospitalQuery        
        $this->view('appointment/appointmentsearchpage', $data);


        $this->view('footer');
    }
    }
