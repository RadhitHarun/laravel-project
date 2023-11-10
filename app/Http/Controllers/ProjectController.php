<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\JobList;
use App\Models\ljkh;
use App\Models\Anumber;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Events\JobValidasiNotification;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //medapatkan semua data category
        $projects = Project::all();
        //jika ada request ajax maka yang direturn adalah datatables
        if ($request->ajax()) {
            return Datatables::of($projects)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    //kita tambahkan button edit dan hapus
                    return view('admin.tombol')->with('projects', $row);
                })
                ->rawColumns(['action'])
                ->make(true);
            }
            
            return view('admin.index', compact('projects'));
        }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Anumber' => [
                'required',
                'min:7',
                'max:7',
                function ($attribute, $value, $fail) {
                    // Pemeriksaan format id_job (A tahun 2 digit + 4 digit urutan + " - " + die_part)
                    if (!preg_match('/^A\d{2}\d{4}$/', $value)) {
                        $fail('Format Anumber tidak valid.');
                    }

                    // Pemeriksaan keberadaan id_job di tabel anumber
                    $anumberExists = Anumber::where('A_number', substr($value, 0, 7))->exists();
                    if (!$anumberExists) {
                        $fail('Anumber tidak terdaftar!');
                    }
                },
            ],
        ]);

        $project =  Project::create([
                        'project'   => $request->project,
                        'Anumber'   => $request->Anumber,
                        'part_name' => $request->part_name,
                    ]);

        $jobList = JobList::create([
                        'id_job'     => $request->Anumber,
                        'project_id' => $project->id,
                        'project'    => $project->project,
                        'part_name'  => $project->part_name,
                        'validasi'   => 'Belum Divalidasi',
                        'status_job' => 'queued'
                    ]);

        $ljkh = ljkh::create([
                        'job_id'    => $jobList->id,
                        'id_job'    => $jobList->id_job,
                        'project'   => $jobList->project,
                        'die_part'  => $project->part_name,
                        'status'    => 'Belum Divalidasi'
                    ]);

        broadcast(new JobValidasiNotification());

        return response()->json(['success' => true]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $project = Project::find($id);
        return response()->json($project);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $project = Project::find($id);
        $project->project   = $request->project;
        $project->Anumber   = $request->Anumber;
        $project->part_name = $request->part_name;
        $project->save();

        $jobList = JobList::where('project_id', $project->id)->first();
        if ($jobList) {
            $jobList->id_job = $request->Anumber; // Atur deskripsi yang diperbarui
            $jobList->project = $request->project; // Atur deskripsi yang diperbarui
            $jobList->save();
        }

        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $project = Project::find($id);
        if ($project) {
            $project->delete();
            
            // Hapus juga catatan job_list terkait (jika ada)
            JobList::where('project_id', $project->id)->delete();
        }

        return response()->json(['success' => true]);
    }
}
