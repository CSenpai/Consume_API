<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Libraries\BaseApi;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Mengambil data dari input search
        $search = $request->search;
        // Memanggil Libraries BaseApi method nya index dengan mengirim parameter1 berupa path data dari API nya,
        // parameter2 data untuk mengisi search_nama API nya.
        $data = (new BaseApi)->index('/api/students', ['search_nama' => $search]);
        // Ambil respones jsonnya
        $students = $data->json();
        // dd($students);
        // Kirim hasil preview pengambilan data ke blade index
        // return view('index')->with(['students' => $students]);
        return view('index')->with(['students' => $students ['data']]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            'nama' => $request->nama,
            'nis' => $request->nis,
            'rombel' => $request->rombel,
            'rayon' => $request->rayon,
        ];
        $proses = (new BaseApi)->store('/api/students/tambah-data', $data);
        if ($proses->failed()) {
            $errors = $proses->json('data');
            return redirect()->back()->with(['errors' => $errors]);
        }else {
            return redirect('/')->with('success', 'Berhasil menambahkan data baru ke students API');
        }
    }

    public function createToken()
    {
        return csrf_token();
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // coba baris kode didalam try
        try {
            // ambil data dari table students yang id nya sama kaya $id dari path routenya
            // where & find fungsi mencari, bedanya : where nyari berdasarkan column apa aja boleh, kalau find cuman bisa cari berdasarkan id
            $student = Student::find($id);
            if ($student) {
                // kalau data berhasil diambil, tampilkan data dari $student nya dengan tanda status code 200
                return ApiFormatter::createAPI(200, 'success', $student);
            }else {
                // kalau data gagal diambil/data gaada, yg dikembaliin status code 400
                return ApiFormatter::createAPI(400, 'failed');
            }
        } catch (Exception $error) {
            // kalau pas try ada error, deskripsi error nya ditampilkan dengan status code 400
            return ApiFormatter::createAPI(400, 'error', $error->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        // Proses diambil data api ke route REST API /students/{id}
        $data = (new BaseApi)->edit('/api/students/'.$id);
        if ($data->failed()) {
            // Kalau gagal proses $data diatas, ambil deskripsi error dari json property data
            $errors = $data->json();
            // Balikin ke halamaan awal, sama errors nya
            return redirect()->back()->with(['errors' => $errors]);
        } else {
            // Kalau berhasil, ambil data dari jsonnya
            $student = $data->json(['data']);
            // Alihin ke blade edit dengan mengirim data $student diatas agar bisa digunakan pada blade
            return view('edit')->with(['student' => $student]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }

    public function trash()
    {
        $proses = (new BaseApi)->trash('/api/students/show/trash');
        if ($proses->failed()) {
            $errors = $proses->json('data');
            return redirect()->back()->with('errors', $errors);
        } else {
            $studentsTrash = $proses->json('data');
            return view('trash')->with(['studensTrash' => $studentsTrash]);
        }
    }

    public function restore($id)
    {
        //
    }

    public function permanentDelete($id)
    {
        //
    }
}