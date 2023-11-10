<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\ljkh;
use App\Models\Anumber;
use App\Models\JobList;
use App\Models\Product;
use App\Models\activity;
use App\Models\operator;
use App\Exports\LJKHExport;
use App\Imports\LJKHImport;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    // Start Dashboard
    public function dashboard()
    {
        return view('admin.DashboardAdmin');
    }
    // End Dashboard

    // Start LJKH
    public function index(Request $request)
    {
        $search = $request->input('search');
        Paginator::useBootstrap();
        $ljkh = ljkh::whereIN('status', ['Complete', 'Complete-NPK'])
                    ->where(function($query) use ($search) {
                        $query  ->where('Date', 'LIKE', "%$search%")
                                ->orWhere('id_mch', 'LIKE', "%$search%")
                                ->orWhere('id_job', 'LIKE', "%$search%")
                                ->orWhere('sub', 'LIKE', "%$search%")
                                ->orWhere('activity_name', 'LIKE', "%$search%");
                    })->simplePaginate(10);
        
        return view('admin.ljkh', compact('ljkh','search'));
    }

    public function create()
    {
        $idMchs = Operator::pluck('id_mch', 'id_mch');
        $taskNames = activity::pluck('activity_name', 'activity_name');
        $anumbers = Anumber::pluck('A_number', 'A_number');

        return view('admin.addLJKH', compact('idMchs','taskNames', 'anumbers'));
    }

    public function store(Request $request)
    {
        $date = Carbon::now()->toDateString(); 
        $time = Carbon::now()->toTimeString(); 
        
        $data = $request->all();
        $data['Date'] = $date;
        $data['start'] = $time;
    
        $product = ljkh::create($data);
    
        // Menghitung produksi
        $productionHour = $this->getProductionHour($product->start, $product->stop);
    
        // Menyimpan data produksi ke dalam kolom prod_hour
        $product->prod_hour = $productionHour;
        $product->save();
    
        return redirect()->route('admin.addLJKH')->with('success', 'Job added successfully');
    }

    public function edit(string $id)
    {
        $ljkh = ljkh::findOrFail($id);
        $idMchs = Operator::pluck('id_mch', 'id_mch');
        $idJob = anumber::pluck('A_number', 'A_number');
        $taskNames = activity::pluck('activity_name', 'activity_name');

        return view('admin.editLJKH', compact('ljkh','idMchs','idJob','taskNames'));
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'id_job'=>'required',
            'project'=>'required',
            'die_part' => 'required|in:70,71,72',
        ]);
    
        if ($validator->fails()) {
            return redirect()->route('job.edit', ['id' => $id])
                ->withErrors($validator)
                ->withInput();
        }
    
        $diePart = $request->die_part; // Angka die_part (70, 71, 72)
        $idJob = $request->id_job . ' - ' . $request->die_part;
        $diePartLabel = $this->getDiePartLabel($diePart);

        $ListJob = JobList::findOrFail($id);
        $project = $request->project;
        $status = $ListJob->status;
        $ListJob->update([
            'project'       => $project,
            'id_mch'        => $request->id_mch,
            'work_ctr'      => $request->work_ctr,
            'die_part'      => $diePartLabel,
            'activity_name' => $request->activity_name,
            'status'        => $status
        ]);
        
        ljkh::where('id_job', $idJob)->update([
            'project'       => $project,
            'id_mch'        => $request->id_mch,
            'work_ctr'      => $request->work_ctr,
            'die_part'      => $diePartLabel,
            'activity_name' => $request->activity_name,
            'date_stop'     => $request->date_stop,
            'status'        => $status
        ]);
        
        
        return redirect()->route('admin.ljkh')->with('success', 'LJKH berhasil diupdate');
    }

    public function destroy(string $id)
    {
        $product = ljkh::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.ljkh')->with('success', 'job deleted successfully');
    }

    // public function showImportLJKHForm()
    // {
    //     return view('products.import'); 
    // }

    public function exportLJKH()
    {
        $fileName = Carbon::now()->format('Y-m'). '-Data Entry' . '.xlsx';
        return Excel::download(new LJKHExport, $fileName);
    }

    public function importLJKH(Request $request)
    {
        $file = $request->file('file');
        Excel::import(new LJKHImport, $file);

        // return redirect()->route('products.index')->with('success', 'Data berhasil diimpor');
        return response()->json(['message' => 'Data berhasil diimpor']);
    }
    // End LJKH

    protected function getDiePartLabel($diePart)
    {
        switch ($diePart) {
            case '70':
                return 'Upper';
            case '71':
                return 'Lower';
            case '72':
                return 'Pad';
            default:
                return '';
        }
    }


}
