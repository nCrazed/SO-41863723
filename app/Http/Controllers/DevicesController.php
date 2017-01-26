<?php

namespace App\Http\Controllers;


use App\Device;
use App\RFDevice;
use App\User;
use App\UserDevice;
use Illuminate\Http\Request;

class DevicesController extends Controller
{

    private $deviceModel;
    private $rfDeviceModel;
    private $userModel;
    private $userDeviceModel;

    public function __construct(Device $deviceModel, RFDevice $rfDeviceModel, User $userModel, UserDevice $userDeviceModel)
    {
        $this->middleware('guest');

        $this->deviceModel = $deviceModel;
        $this->rfDeviceModel = $rfDeviceModel;
        $this->userModel = $userModel;
        $this->userDeviceModel = $userDeviceModel;
    }

    public function add(Request $request)
    {
        $name = $request->input('name');
        $description = $request->input('description');
        $onCode = $request->input('onCode');
        $offCode = $request->input('offCode');
        $pulseLength = $request->input('pulseLength');
        $type = 1;

        $this->deviceModel->add();
        $this->rfDeviceModel->add();
        $this->userDeviceModel->add();

        return redirect()->route('devices');
    }
}
