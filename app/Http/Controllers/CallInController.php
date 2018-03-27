<?php

namespace App\Http\Controllers;

use App\Alarm;
use App\Clients;
use App\Help;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class CallInController extends Controller
{
    public function show($type, $id)
    {
        if($type == '2') {
            $call = Alarm::findOrFail($id);
        }
        else{
            $call = Help::findOrFail($id);
        }
        return view('callin.show',['call'=>$call, 'client'=>$call->client, 'type'=>$type]);
    }

    public function add($clientId = null)
    {
        if($clientId!==null) {
            $client = Clients::findOrFail($clientId);
        }
        else{
            $client = new Clients();
        }
        return view ('callin.form', ['client'=>$client]);
    }

    public function interact($id, $type)
    {
        if($type == '2') {
            $call = Alarm::findOrFail($id);
        }
        else{
            $call = Help::findOrFail($id);
        }
        return view('callin.show',['call'=>$call, 'type'=>$type]);
    }

    public function close(Request $request)
    {
        $id = $request->input('id');
        $type = $request->input('type');
        $actualDate = new \DateTime();
        if($type == '2') {
            $call = Alarm::findOrFail($id);
        }
        else{
            $call = Help::findOrFail($id);
        }
        $call->closed_at = $actualDate->format('Y-m-d H:i:s');
        $call->save();
        return redirect(route('call.list'));

    }

    public function search()
    {
        
         $clients = Clients::whereNull('parent_client')->orderBy('name')->get();
         return view('callin.list_client',['clients'=>$clients, 'strSearch'=>'']);
    }

    public function list($status=1)
    {

        $queryAlarm = Alarm::select();
        $queryHelp = Help::select();
        if($status=='1') {
            $queryAlarm->whereNull('closed_at');
            $queryHelp->whereNull('closed_at');
        }
        if ($status =='2') {
            $queryAlarm->whereNotNull('closed_at');
            $queryHelp->whereNotNull('closed_at');
        }
        $queryAlarm->orderBy('closed_at');
        $collectionHelp = $queryHelp->get();
        $collectionAlarm = $queryAlarm->get();
        $calls = ['alarm'=>$collectionAlarm, 'help'=>$collectionHelp];
        return view('callin.list',['calls'=>$calls]);
    }

    public function store(Request $request)
    {


        $actualDate = new \DateTime();
        $interaction = [];
        $data = $request->toArray();
        if($data['type']=='2'){
            $callIn = new Alarm();
        }
        if($data['type']=='1') {
            $callIn = new Help();
        }
        $callIn->client_id = $data['client_id'];
        $callIn->description = $data['description'];
        $callIn->opened_at = $actualDate->format('Y-m-d H:i:s');
        $callIn->points = \json_encode([]);
        $callIn->created_at = $actualDate->format('Y-m-d H:i:s');
        $firstInteraction = new \stdClass();
        $firstInteraction->title = "Chamado Aberto por: ".Auth::user()->name;
        $firstInteraction->datetime = $actualDate->format('d/m/Y H:i:s');
        $interaction[] = $firstInteraction;
        $callIn->interactions=\json_encode($interaction);
        $callIn->save();

        return redirect(route('call.list',['status'=>1]));
    }

    public function searchClient(Request $request)
    {
        $strSearch = $request->input('search');
        $clients = Clients::orWhere('name','like', "%{$strSearch}%")
            ->orWhere('cpf','like', "%{$strSearch}%")
            ->orWhere('tel_res','like', "%{$strSearch}%")
            ->orWhere('tel_cel','like', "%{$strSearch}%")
            ->orWhere('code','=',"{$strSearch}")
            ->orWhere('tel_com','like', "%{$strSearch}%")->get();
        return view('callin.list_client',['clients'=>$clients, 'strSearch'=>$strSearch]);
    }

    public function storeInteraction(Request $request)
    {
        $actualDate = new \DateTime();

        $data = $request->toArray();
        if($data['type']=='2'){
            $callIn = Alarm::findOrFail($data['id']);
        }
        if($data['type']=='1') {
            $callIn = Help::findOrFail($data['id']);
        }
        $interaction = $callIn->interactions;
        $callIn->updated_at = $actualDate->format('Y-m-d H:i:s');
        $callIn->created_at = $actualDate->format('Y-m-d H:i:s');
        $firstInteraction = new \stdClass();
        $firstInteraction->title = $data['description'];
        $firstInteraction->datetime = $actualDate->format('d/m/Y H:i:s');
        $interaction[] = $firstInteraction;
        $callIn->interactions=\json_encode($interaction);
        $callIn->save();
        return redirect(route('call.show',['type'=>$data['type'], 'id'=>$data['id']]));

    }



}
