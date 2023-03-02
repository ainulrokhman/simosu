<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    protected $USER;
    public function __construct()
    {
        parent::__construct();
        $this->USER = $this->session->userdata('session');
        if (!$this->USER) {
            redirect(base_url('user/login'));
        }
    }

    public function form()
    {
        if ($this->input->method() == "post") {
            date_default_timezone_set("Asia/Jakarta");
            $sensors = $this->input->post();
            $waktu = $this->input->post('waktu');
            $data = [];
            foreach ($sensors as $key => $sensor) {
                if ($key != "waktu") {
                    $sensor = $this->input->post($key, true) / 10;
                    $data[] = [
                        "sensor_id" => $key,
                        "nilai" => $sensor,
                        "waktu" => date('Y-m-d H:i:s', $waktu)
                    ];
                }
            }

            // return $this->output
            //     ->set_content_type('application/json')
            //     ->set_status_header(200)
            //     ->set_output(json_encode($data));

            $insert = $this->db->insert_batch('data_suhu', $data);
            if (!$insert) {
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(400)
                    ->set_output(json_encode(["message" => "error"]));
            }
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(["message" => "success"]));
        }
    }

    public function voucher()
    {
        $data = [
            "validity" => "12h",
            "timelimit" => "7d",
            "getsprice" => "5000",
            "qr" => "",
            "usermode" => "vc",
            "hotspotname" => "aaa",
            "datalimit" => "",
            "logo" => "https://freepngimg.com/thumb/whatsapp/4-2-whatsapp-transparent.png",
            "dnsname" => "anenyong.net",
            "price" => "Rp. 1000",
            "num" => "1",
            "username" => "username",
            "getuprofile" => "getuprofile",
            "mks" => "mks",
            "v_opsi" => "up",
        ];
        $this->load->view('voucher', $data);
    }

    public function chart()
    {
        $this->load->view('chart');
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['colors'] = ['success', 'danger', 'warning', 'info', 'primary', 'secondary'];
        $data['data'] = [
            [
                'name' => 'Alat 1',
                'sensors' => [
                    rand(0, 100),
                    rand(0, 100),
                    rand(0, 100),
                    rand(0, 100),
                    rand(0, 100),
                ],
            ],
            [
                'name' => 'Alat 2',
                'sensors' => [
                    rand(0, 100),
                    rand(0, 100),
                    rand(0, 100),
                    rand(0, 100),
                    rand(0, 100),
                ],
            ],
            [
                'name' => 'Alat 3',
                'sensors' => [
                    rand(0, 100),
                    rand(0, 100),
                    rand(0, 100),
                    rand(0, 100),
                    rand(0, 100),
                ],
            ],
            [
                'name' => 'Alat 4',
                'sensors' => [
                    rand(0, 100),
                    rand(0, 100),
                    rand(0, 100),
                    rand(0, 100),
                    rand(0, 100),
                ],
            ],
            [
                'name' => 'Alat 5',
                'sensors' => [
                    rand(0, 100),
                    rand(0, 100),
                    rand(0, 100),
                    rand(0, 100),
                    rand(0, 100),
                ],
            ],
            [
                'name' => 'Alat 6',
                'sensors' => [
                    rand(0, 100),
                    rand(0, 100),
                    rand(0, 100),
                    rand(0, 100),
                    rand(0, 100),
                ],
            ],
        ];




        template_view('template/index', $data);
    }

    public function push()
    {
        $data = [];

        // if ($this->input->method() === 'post') {
        // }
        $data = [
            // 'labels' => date('H:i'),
            'labels' => [
                'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j'
            ],
            'datasets' => [
                [
                    'label' => 'sensor1',
                    'fill' => false,
                    'lineTension' => 0.1,
                    'borderColor' => 'rgb(255,0,0)',
                    'backgroundColor' => 'rgb(255,0,0)',
                    'data' => [rand(35, 75), rand(35, 75), rand(35, 75), rand(35, 75), rand(35, 75), rand(35, 75), rand(35, 75), rand(35, 75), rand(35, 75), rand(35, 75)],
                    'spanGaps' => true,
                ],
                [
                    'label' => 'sensor2',
                    'fill' => false,
                    'lineTension' => 0.1,
                    'borderColor' => 'rgb(0,0,255)',
                    'backgroundColor' => 'rgb(0,0,255)',
                    'data' => [rand(35, 75), rand(35, 75), rand(35, 75), rand(35, 75), rand(35, 75), rand(35, 75), rand(35, 75), rand(35, 75), rand(35, 75), rand(35, 75)],
                    'spanGaps' => true,
                ],
                [
                    'label' => 'sensor3',
                    'fill' => false,
                    'lineTension' => 0.1,
                    'borderColor' => 'rgb(0,0,0)',
                    'backgroundColor' => 'rgb(0,0,0)',
                    'data' => [rand(35, 75), rand(35, 75), rand(35, 75), rand(35, 75), rand(35, 75), rand(35, 75), rand(35, 75), rand(35, 75), rand(35, 75), rand(35, 75)],
                    'spanGaps' => true,
                ],

            ],
        ];
        echo json_encode($data);
    }
}
