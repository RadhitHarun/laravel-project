<?php

namespace App\Http\Controllers;

use App\Models\ljkh;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\JobList;
use App\Models\operator;
use Yajra\DataTables\Facades\DataTables;
class ForemanController extends Controller
{
    Public Function currentProcess() 
    {
        $mesin302 = ljkh::where('id_mch', 302)
                    ->where('status', 'In progress')
                    ->orderBy('id')->first();
        $mesin303 = ljkh::where('id_mch', 303)
                    ->where('status', 'In progress')
                    ->orderBy('id')->first();
        $mesin304 = ljkh::where('id_mch', 304)
                    ->where('status', 'In progress')
                    ->orderBy('id')->first();
        $mesin317 = ljkh::where('id_mch', 317)
                    ->where('status', 'In progress')
                    ->orderBy('id')->first();
        $mesin322 = ljkh::where('id_mch', 322)
                    ->where('status', 'In progress')
                    ->orderBy('id')->first();
        $mesin323 = ljkh::where('id_mch', 323)
                    ->where('status', 'In progress')
                    ->orderBy('id')->first();
        $mesin325 = ljkh::where('id_mch', 325)
                    ->where('status', 'In progress')
                    ->orderBy('id')->first();
        $mesinMCRBIII = ljkh::where('id_mch', 'MCR BIII')
                    ->where('status', 'In progress')
                    ->orderBy('id')->first();
        $mesinOkamoto = ljkh::where('id_mch', 'OKAMOTO')
                    ->where('status', 'In progress')
                    ->orderBy('id')->first();
        $mesinEquiptop = ljkh::where('id_mch', 'EQUIPTOP')
                    ->where('status', 'In progress')
                    ->orderBy('id')->first();

        return view('foreman.DashboardForeman', 
        compact('mesin302', 'mesin303', 'mesin304', 'mesin317', 'mesin322', 'mesin323', 'mesin325', 'mesinMCRBIII','mesinOkamoto', 'mesinEquiptop'));
    }

    public function index(Request $request)
    {
        $idMchs = Operator::pluck('id_mch', 'id_mch');
        $search = $request->input('search');
        
        $user_id_mch = Auth::user()->id_mch;

        $WS = JobList::where('id_mch', $user_id_mch)
            ->when($search, function ($query) use ($search) {
                $query->where('id_mch', 'LIKE', "%$search%")
                    ->orWhere('id_job', 'LIKE', "%$search%")
                    ->orWhere('die_part', 'LIKE', "%$search%");
            })
            ->paginate(10);

        return view('foreman.index', compact('WS', 'search', 'idMchs'));
    }

    public function showByMch(Request $request)
    {
        $selectedMch = $request->input('selected_mch');
        
        // Fetch job lists based on the selected id_mch
        $WS = JobList::where('id_mch', $selectedMch)->get();
        
        $idMchs = Operator::pluck('id_mch', 'id_mch'); // Add this line to fetch idMchs again
        
        return view('foreman.index', compact('WS', 'idMchs'));
    }

    public function store(Request $request)
    {
        // 
    }

    public function update($id){
        // 
    }

    public function indexValidasi(Request $request) 
    {
        $user = Auth::user();
        $validasi = JobList::where('validasi', 'Belum Divalidasi')->get();
        $idMchs = User::where('sub', $user->sub)->pluck('id_mch', 'id_mch');

        if($request->ajax()){
            return Datatables::of($validasi)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return view('foreman.tombol')->with('validasi', $row);
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('foreman.validasi', compact('validasi', 'idMchs'));
    }

    public function validated(Request $request) 
    {
        $validated = JobList::where('validasi', 'Sudah Divalidasi')->get();

        if($request->ajax()){
            return Datatables::of($validated)
            ->addIndexColumn()
            ->make(true);
        }

        return view('foreman.validasi', compact('validated', 'idMchs'));
    }

    public function showJob($id)
    {
        $validasi = JobList::find($id);
        return response()->json($validasi);
    }

    public function validasiJob(Request $request, $id)
    {
        $validasi = JobList::find($id);
        $validasi->update([
            'id_mch'    => $request->id_mch,
            'lead_time' => $request->lead_time,
            'validasi'  => 'Sudah Divalidasi',
            'status_job'=> 'queued'
        ]);

        $idMch = $request->id_mch;
        $workCntr = $this->getWorkCntr($idMch);

        ljkh::where('job_id', $id)->update([
            'id_mch'    => $request->id_mch,
            'status'    => 'queued',
            'work_ctr'  => $workCntr
        ]);

        return response()->json(['success' => true]);
    }

    protected function getWrkCntr($idMch)
    {
        switch ($idMch) {
            case '320': 
            case '321': 
            case '322': 
            case '323': 
            case '324': 
            case '325': 
                $wrkCntr = 'MCH-MED';
                break;
            case 'EQUIPTOP':
            case 'OKAMOTO':
                $wrkCntr = 'MCH-SML';
                break;
            case '302':
            case '303':
            case '304':
            case 'KBT 11':
            case 'MCR BIII':
                $wrkCntr = 'MCH-BIG';
                break;
            default:
                $wrkCntr = '';
        }
        return $wrkCntr;
    }
}
