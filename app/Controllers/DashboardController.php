<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BookingModel;


class DashboardController extends BaseController
{
    public function index()
    {
        return view('Dashboards\index');
    }

    
	public function loadData()
	{
		$booking = new BookingModel();
		// on page load this ajax code block will be run
		$data = $booking->where([
			'start >=' => $this->request->getVar('start'),
			'end <='=> $this->request->getVar('end')
		])->findAll();

		return json_encode($data);
	}

	public function ajax()
	{
        // print_r('cekkkk');exit;
		$booking = new BookingModel();

		switch ($this->request->getVar('type')) {

				// For add EventModel
			case 'add':
				$data = [
					'title' => $this->request->getVar('title'),
					'start' => $this->request->getVar('start'),
					'end' => $this->request->getVar('end'),
				];
				$booking->insert($data);
				return json_encode($booking);
				break;

				// For update EventModel        
			case 'update':
				$data = [
					'title' => $this->request->getVar('title'),
					'start' => $this->request->getVar('start'),
					'end' => $this->request->getVar('end'),
				];

				$booking_id = $this->request->getVar('id');
				
				$booking->update($booking_id, $data);

				return json_encode($booking);
				break;

				// For delete EventModel    
			case 'delete':

				$booking_id = $this->request->getVar('id');

				$booking->delete($booking_id);

				return json_encode($booking);
				break;

			default:
				break;
		}
	}
}
