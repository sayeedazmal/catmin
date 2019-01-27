<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {


	function __construct()
    {
        parent::__construct();

        $this->load->helper(array('form', 'url', 'html'));


        $this->load->model(['Student'], '', TRUE);




    }

	public function index()
	{


        $data = $cond = $this->input->get();
				$data["counter"]=0;
        $data['students']    = $this->Student->get_list($data['counter'], ROW_PER_PAGE, $cond);





        $config['base_url'] = site_url('Survey/index/');

        $data['total_rows'] = $config['total_rows'] = $this->Student->get_list(0, 0, $cond);


      //  $this->paginate($config);

        $data['headline'] = $data['title'] = 'Activity Info';

				$this->layout("Survey/index",$data);
	}

	public function layout($view_locator, $data = null, $is_report = false, $return = false)
	{
			//get title and headline from data
			$title = (isset($data['title']) ? $data['title'] : 'INSIGHT');
			$headline = (isset($data['headline']) ? $data['headline'] : 'INSIGHT');

			if ($return) {
					return $this->load->view('Layout/master', ['content' => $this->load->view($view_locator, $data, true), 'title' => $title, 'headline' => $headline, 'is_report' => $is_report], true);
			} else {
					$this->load->view('Layout/master', ['content' => $this->load->view($view_locator, $data, true), 'title' => $title, 'headline' => $headline, 'is_report' => $is_report]);
			}
	}
}
