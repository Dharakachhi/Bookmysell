<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pdf_Controller extends CI_Controller {

	public function index()
	{
		$mpdf = new \Mpdf\Mpdf([
			    'mode' => 'utf-8',
			    'format' => [190, 236],
			    'orientation' => 'L'
			]);
        $html = $this->load->view('dashboard/mpdf',[],true);
        $mpdf->WriteHTML($html);
        $mpdf->Output(); // opens in browser
	}

}

/* End of file Pdf_Controller.php */
/* Location: ./application/controllers/Pdf_Controller.php */