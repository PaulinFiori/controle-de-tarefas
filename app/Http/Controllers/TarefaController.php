<?php

namespace App\Http\Controllers;

use Mail;
use App\Models\Tarefa;
use Illuminate\Http\Request;
use App\Mail\NovaTarefaMail;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TarefasExport;
use PDF;

class TarefaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tarefas = Tarefa::where('user_id', auth()->user()->id)->paginate(6);

        return view('tarefa.index', ['tarefas' => $tarefas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tarefa.criar');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dados = $request->all('nome', 'data_limite');
        $dados['user_id'] = auth()->user()->id;

        $tarefa = Tarefa::create($dados);
        Mail::to(auth()->user()->email)->send(new NovaTarefaMail($tarefa));

        return redirect()->route('tarefa.show', ['tarefa' => $tarefa->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function show(Tarefa $tarefa)
    {
        return view("tarefa.mostra", ["tarefa" => $tarefa]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function edit(Tarefa $tarefa)
    {
        if($tarefa->user_id == auth()->user()->id) {
            return view('tarefa.editar', ['tarefa' => $tarefa]);
        } 

        return view('acesso-negado');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tarefa $tarefa)
    {
        if($tarefa->user_id == auth()->user()->id) {
            $tarefa->update($request->all());
            return view('tarefa.mostra', ['tarefa' => $tarefa]);
        }

        return view('acesso-negado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tarefa $tarefa)
    {
        if($tarefa->user_id == auth()->user()->id) {
            $tarefa->delete();
            return redirect()->route("tarefa.index");
        }

        return view('acesso-negado');
    }

    public function exportacaoExcel() {
        return Excel::download(new TarefasExport, 'tarefas.csv');
    }

    public function exportacaoPdf() {
        $tarefas = auth()->user()->tarefas()->get();
        $pdf = Pdf::loadView('pdf.tarefas', ['tarefas' => $tarefas]);
        $pdf->setPaper('a4', 'portrait');

        //return $pdf->download('tarefas.pdf');
        return $pdf->stream('tarefas.pdf');
        //return Excel::download(new TarefasExport, 'tarefas.pdf');
    }
}
