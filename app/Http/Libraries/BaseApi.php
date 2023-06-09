<?php
// Perbedaan Helpers dan Libraries
// Helpers = Membuat API
// Libraries = Memakai API
namespace App\Http\Libraries;
// Mengatur posisi file : namespace
use Illuminate\Support\Facades\Http;

class BaseApi
{
    // Variable yang cuman bisa diakses di class ini dan turunannya
    protected $baseUrl;
    // Constractor : 
    public function __construct()
    {
        $this->baseUrl = "http://127.0.0.1:2222";
    }
    private function client()
    {
        return Http::baseUrl($this->baseUrl);
    }
    public function index(String $endpoint, Array $data = [])
    {
        return $this->client()->get($endpoint, $data);
    }
    public function store(String $endpoint, Array $data = [])
    {
        // Pake post() karena buat route tambah data di project REST API nya pake ::post
        return $this->client()->post($endpoint, $data);
    }
    public function edit(String $endpoint, Array $data = [])
    {
        return $this->client()->get($endpoint, $data);
    }
    public function update(String $endpoint, Array $data = [])
    {
        return $this->client()->post($endpoint, $data);
    }
}

?>