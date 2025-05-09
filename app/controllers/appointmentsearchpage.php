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
        $totalResults = 0;

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
            $totalResults = is_countable($doctorResults) ? count($doctorResults) : 0;
            $totalPages = ceil($totalResults / $limit);
            $offset = ($currentPage - 1) * $limit;
            $doctorResults = is_array($doctorResults) ? array_slice($doctorResults, $offset, $limit) : [];
        }
          $clerkModel = new ClerkModel();
          if (isset($_SESSION['USER']) && $_SESSION['USER'] !== null && $_SESSION['USER']->role === 'reception_clerk'){
        $clerkDetails=$clerkModel->getReceptionClerkHospitalByUserId($_SESSION['USER']->user_id);
        
    };
        
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
            'doctorNames' => $doctorNames,
            'clerkDetails' => isset($_SESSION['USER']) && $_SESSION['USER'] !== null && $_SESSION['USER']->role === 'reception_clerk' ? $clerkDetails : null
        ];

        //currently empty queries are  $hospitalQuery        
        $this->view('appointment/appointmentsearchpage', $data);


        $this->view('footer');
    }
    }
