<?php

class DoctorManageSchedule extends Controller{

    public function index(){

        $this->view('header');

        $hospital = new Hospital;
        // $data['name'] = $_POST['fee'];
        // show( $_POST['hospital']);
        // $hospital = $hospital->where($data, []);

        // $data['date'] = $_POST['date'];
        // $data['start_time'] = $_POST['time'];
        // $data['duration'] = $_POST['duration'];
        // $data['doctor_fee'] = $_POST['fee'];
        // $data['hospital_id'] = $hospital->id;
        // $data['total_slots'] = $_POST['count'];

        // $apptSlot = new ApptSlot;
        // $apptSlot->insert($data);
        // show($hospital->id);

        $apptSlot = new Availabletime;
        $apptSlot = $apptSlot->getByDoctorId($_SESSION['USER']->user_id);
        // show($apptSlot);
        $data = $apptSlot;
        // $hos['id'] = $apptSlot[0]->hospital_id;
        // $hospital = new Hospital;
        // $hospital = $hospital->getHospitalById($apptSlot[0]->hospital_id);
        // $data['hospital'] = $hospital[0]->name;
        // $data['current_date'] = new DateTime();
        // show($data);
        // show($data['hospital']);
        // show($data['current_date']);
        // show($data[0]->date);
        // show($data['current_date']->format('Y-m-d'));

        $this->view('doctorManageSchedule', $data);
        $this->view('footer');

    }

    public function create(){
        $hospital = new Hospital;
        $data['name'] = $_POST['hospital'];
        // show( $_POST['hospital']);
        $hospital = $hospital->first($data);
        // show($hospital->id);

        $data['date'] = $_POST['date'];
        $data['start_time'] = $_POST['time'];
        $data['duration'] = $_POST['duration'];
        $data['doctor_fee'] = $_POST['fee'];
        $data['hospital_id'] = $hospital->id;
        $data['total_slots'] = $_POST['count'];
        $data['doctor_id'] = $_SESSION['USER']->user_id;

        $apptSlot = new Availabletime;
        $apptSlot->insert($data);
        redirect('/doctorManageSchedule');
    }

    public function cancelAppointment($apptId = ""){
        $apptSlot = new Availabletime;
        if(!empty($apptId)){
            $apptSlot->delete($apptId);
        }
        redirect('/doctorManageSchedule');
    }
}