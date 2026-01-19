<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class LevelFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if ($arguments && ! in_array(session('level'), $arguments)) {
            return redirect()->to('/blocked');
        }

        if ($arguments && ! in_array(session('level'), $arguments)) {
            return redirect()->to('/blocked');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}
