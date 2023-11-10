<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\ljkh;
use App\Models\JobList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Yajra\DataTables\Facades\DataTables;
class MemberController extends Controller
{

    public function index(Request $request)
    {
        $user = Auth::user()->id_mch;
        $ljkh = ljkh::select('*')
                ->where('id_mch', $user)
                ->whereIn('status', ['ready', 'In progress', 'queued', 'NPK'])
                ->orderByRaw("(CASE 
                WHEN status = 'ready' THEN 1 
                WHEN status = 'In progress' THEN 2
                WHEN status = 'NPK' THEN 3
                ELSE 4 END), job_id")
                ->first();

        $jobList = JobList::where('status_job', 'ready')->orWhere('status_job', 'In progress')
                        ->where('id_mch', $user)
                        ->first();

        // dd($ljkh);
        return view('member.index', compact('ljkh', 'user', 'jobList'));
    }

    public function indexJob(Request $request)
    {
        $user = Auth::user()->id_mch;
        $ljkh = ljkh::where('status', 'queued')
        ->where('id_mch', $user)
        ->get();

        if($request->ajax()){
            return Datatables::of($ljkh)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '<button class="btn btn-primary text-center takeJob" 
                data-id="'.$row->id.'">Ambil Job</button>';
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('member.index', compact('ljkh'));
    }

    public function takeJob($id)
    {
        try {
            $user = Auth::user()->id_mch;
            $LJKH = ljkh::findOrFail($id);

            if($LJKH->status === 'queued') {
                DB::beginTransaction();

                try {
                    // update ljkh
                    $LJKH->status = 'ready';
                    $LJKH->save();

                    // update job list
                    $jobList = JobList::where('id', $LJKH->job_id)->where('id_mch', $user)->first();
                    $jobList->status_job = 'ready';
                    $jobList->save();

                    DB::commit();

                    return response()->json(['success' => true]);
                }catch (\Exception $e) {
                    DB::rollback();
                    return response()->json(['success' => false, 'message' => 'Error: Gagal update']);
                }
            } else {
                return response()->json(['success' => false, 'message' => 'Job tidak berubah statusnya']);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: gagal ambil job']);
        }
    }

    public function submit(Request $request)
    {
        $date = Carbon::now()->toDateString();
        $time = Carbon::now()->toTimeString();
        $user = Auth::user();
        $data['start'] = $time;
        $data['Date'] = $date;
        $idActivity = $request->input('id_activity');

        $data = $request->validate([
            'activity_name' => 'required|string',
        ]);

        ljkh::create([
            'activity_name' => $request->activity_name,
            'Date'          => $date,
            'start'         => $time,
            'name'          => $user->name,
            'id_mch'        => $user->id_mch,
            'work_ctr'      => 'MCH-PREF',
            'id_job'        => $idActivity,
            'sub'           => $user->sub,
            'status'        => 'running',
        ]);
    
        return response()->json(['message' => 'Data keterangan downtime/idle berhasil disimpan!']);
    }

    public function submitStop($id, Request $request) 
    {
        $time = Carbon::now()->toTimeString();
        $user = Auth::user();

        $ljkh = ljkh::where('id_mch', $user->id_mch)
                ->where(function ($query) {
                    $query->where('id_job', 'like', 'N000%') // Cocokkan yang awalannya "N000"
                        ->orWhere('id_job', 'like', 'G000%'); // Cocokkan yang awalannya "G000"
                })
                ->where('status', 'running')
                ->orderBy('id')
                ->first();

        if ($ljkh) {
            // Perbarui kolom "stop" dengan waktu saat ini
            $ljkh->update(['stop' => $time]);
    
            // Hitung selisih waktu dalam detik
            $timeDiffInSeconds = Carbon::parse($ljkh->stop)->diffInSeconds($ljkh->start);
    
            // Hitung prod_hour
            $formattedTime = $timeDiffInSeconds < 3600 ? ceil($timeDiffInSeconds / 60) . ' Menit' : ceil($timeDiffInSeconds / 3600) . ' Jam';
    
            // Perbarui kolom "prod_hour" dengan nilai yang dihitung
            $ljkh->update([
                'prod_hour' => $formattedTime,
                'status'    => 'updated'
            ]);
    
            return response()->json(['message' => 'downtime/idle selesai']);
        } else {
            return response()->json(['message' => 'Gagal Update'],400);
        }
    }

    public function showJob($id)
    {
        $ljkh = ljkh::find($id);
        return response()->json($ljkh);
    }

    public function jobStart($id, Request $request) 
    {
        $date = Carbon::now()->toDateString(); 
        $time = Carbon::now()->toTimeString(); 
        $user = Auth::user();

        // Ambil data ljkh berdasarkan ID
        $ljkh = ljkh::where('id_mch', $user->id_mch)
                    ->where('status', 'ready')
                    ->orderBy('job_id')
                    ->first();

        // LJKH
        if ($ljkh) 
        {
            $ljkh->update([
                'Date'           => $date,
                'name'           => $user->name,
                'start'          => $time,
                'sub'            => $user->sub,
                'activity_name'  => $request->input('activity_name'),
                'status'         => 'In progress'
            ]);

        }else {
            return response()->json(['error' => 'Data not found'], 404);
        }

        // JOB LIST
        $jobList = JobList::where('id_mch', $user->id_mch)
                        ->where('status_job', 'ready')
                        ->orderBy('project_id')
                        ->first();
    
        if ($jobList) {
            $jobList->update([
                'status_job' => 'In progress'
            ]);
        }else{
            return response()->json(['error' => 'Data joblsit not found'], 404);
        }

        return response()->json(['success' => true]);
    }

    public function jobEnd($id, Request $request)
    {
        $currentJob = Carbon::now();
        $date = Carbon::now()->toDateString();
        $user = Auth::user();

        // LJKH
        $ljkh = ljkh::where('id_mch', $user->id_mch)
                    ->where('status', 'In progress')
                    ->orWhere('status', 'NPK')
                    ->first();

        if ($ljkh) {
            $ljkh->update([
                'stop'      => $currentJob,
                'status'    => 'Complete',
                'date_stop' => $date,
            ]);
    
            // Menghitung selisih waktu dalam detik
            $timeDiffInSeconds = $ljkh->stop->diffInSeconds($ljkh->start);
            // Mengubah waktu ke menit jika kurang dari 1 jam, jika lebih, maka ke jam
            $formattedTime = $timeDiffInSeconds < 3600 ? ceil($timeDiffInSeconds / 60) . ' Menit' : ceil($timeDiffInSeconds / 3600) . ' Jam';
            $ljkh->update([
                'prod_hour' => $formattedTime
            ]);
        }else {
            return response()->json(['error' => 'FAK LAH KATA GUA TEH, DATANYA KEMANA JING!'], 404);
        }

        // JOB LIST
        $jobList = JobList::where('id_mch', $user->id_mch)
                        ->where('status_job', 'In progress')
                        ->first();

        if($jobList) {
            $jobList->update([
                'status_job' => 'Complete'
            ]);
        }else {
            return response()->json(['error' => 'Data joblist not found'], 404);
        }
        
        return response()->json(['success' => true]);
    }
    
    public function nextShift(Request $request) 
    {
        $user = Auth::user();

        // Update 'ljkh' records
        $ljkh = ljkh::where('id_mch', $user->id_mch)
                    ->where('status', 'In progress')
                    ->orderBy('id')
                    ->get();
    
        if ($ljkh) {
            foreach ($ljkh as $l) {
                $l->update([
                    'note'   => $request->input('activity_name'),
                    'status' => 'Complete',
                ]);
                $dupLjkh = $l->replicate();
                $dupLjkh->job_id        = null;
                $dupLjkh->Date          = null;
                $dupLjkh->name          = null;
                $dupLjkh->activity_name = null;
                $dupLjkh->start         = null;
                $dupLjkh->prod_hour     = null;
                $dupLjkh->stop          = null;
                $dupLjkh->date_stop     = null;
                $dupLjkh->status        = 'queued';
                if ($dupLjkh->save()) {
                    // Data berhasil tersimpan
                } else {
                    return response()->json(['message' => 'Gagal duplikat job'], 500);
                }
            }
        } else {
            return response()->json(['error' => 'Not Found'], 400);
        }
    
        // Update 'jobList' status
        $jobList = JobList::where('id_mch', $user->id_mch)
                        ->where('status_job', 'In progress')
                        ->first();
    
        if ($jobList) {
            $jobList->update(['status_job' => 'Complete']);
        } else {
            return response()->json(['error' => 'Joblist Not Found'], 400);
        }
    
        return response()->json(['success' => true]);
    }
    
    public function cancelJob($id, Request $request)
    {
        $user = Auth::user();

        $jobList = JobList::where('status_job', 'In progress')
                            ->where('id_mch', $user->id_mch)
                            ->orderby('id')->first();
        if(!$jobList){
            return redirect()->route('member.index')->with('error', 'Job Tidak Ditemukan');
        }

        $ljkh = ljkh::where('status', 'In progress')
                    ->where('id_mch', $user->id_mch)
                    ->orderby('id')->first();

        if(!$ljkh){
            return redirect()->route('member.index')->with('error', 'Job Tidak Ditemukan');
        }

        $jobList->status_job = 'Cancelled';
        $jobList->save();

        $ljkh->status = 'Cancelled';
        $ljkh->save();

        return response()->json(['success' => true]);
    }

    public function autoRun($id, Request $request)
    {
        $date = Carbon::now()->toDateString();
        $time = Carbon::now();
        $user = Auth::user();
        
        // Menghentikan pekerjaan dengan status "In progress"
        $ljkhInProgress = ljkh::where('id_mch', $user->id_mch)
            ->where('status', 'In progress')
            ->first();
        
        if ($ljkhInProgress) 
        {
            $ljkhInProgress->update([
                'stop'      => $time,
                'status'    => 'Complete-NPK',
                'date_stop' => $date,
            ]);
        
            // Menghitung selisih waktu dalam detik
            $timeDiffInSeconds = $ljkhInProgress->stop->diffInSeconds($ljkhInProgress->start);
        
            // Mengubah waktu ke menit jika kurang dari 1 jam, jika lebih, maka ke jam
            $formattedTime = $timeDiffInSeconds < 3600 ? ceil($timeDiffInSeconds / 60) . ' Menit' : ceil($timeDiffInSeconds / 3600) . ' Jam';
        
            // Menghentikan `jobStart` yang sedang berjalan
            $ljkhInProgress->update([
                'prod_hour' => $formattedTime
            ]);
            
        }else
        {
            return response()->json(['message' => 'Tidak ada pekerjaan In progress'], 400);
        }
        
        // Menduplikasi pekerjaan dengan status "Complete-NPK"
        $ljkhCompleteNPK = ljkh::where('id_mch', $user->id_mch)
                                ->where('status', 'Complete-NPK')
                                ->get();
        
        if ($ljkhCompleteNPK->isEmpty()) 
        {
            return response()->json(['message' => 'Tidak ada pekerjaan Complete-NPK'], 400);
        } else 
        {
            foreach ($ljkhCompleteNPK as $completeNPK) {
                $newLjkh = $completeNPK->replicate();
                $newLjkh->job_id = null; // Kosongkan job_id
                $newLjkh->activity_name = $request->input('activity_name');
                $newLjkh->Date = $date;
                $newLjkh->start = $time;
                $newLjkh->status = 'NPK';
        
                if ($newLjkh->save()) {
                    // Pekerjaan yang baru berhasil disimpan
                } else {
                    return response()->json(['message' => 'Gagal menyimpan pekerjaan yang diduplikasi'], 500);
                }
            }
        }
        
        return response()->json(['message' => 'Job Sedang Auto Run']);
    }
    

}
