<?php

namespace App\Controllers;

use App\Models\BarangModel;
use App\Models\EngineMaintenanceModel;
use App\Models\NonEngineMaintenanceModel;

class DashboardController extends BaseController
{
    protected $barang;
    protected $engine;
    protected $nonEngine;

    public function __construct()
    {
        $this->barang     = new BarangModel();
        $this->engine     = new EngineMaintenanceModel();
        $this->nonEngine  = new NonEngineMaintenanceModel();
    }

    public function index()
    {
        $level = session('level'); // admin, supervisor, operator, viewer

        return view('dashboard/index', [
            'level'          => $level,
            'totalBarang'    => $this->barang->countAll(),
            'engineCount'    => $this->engine->countAll(),
            'nonEngineCount' => $this->nonEngine->countAll(),
            'active'         => 'dashboard'
        ]);
    }
}
