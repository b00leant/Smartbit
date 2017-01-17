<?php

namespace App\Http\Controllers;

use Auth;
use View;
use App\Http\Requests;
use Illuminate\Http\Request;
use App;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function index()
    {
        //
    }*/
    public function index(Request $request)
    {
        //return View::make('home');
        if($request->ajax()){
            $index = $request->input('index');
            $people = App\Person::orderBy('id', 'desc')->paginate(6);
            return $people;
        }else{
            $response = array(['success' => 'false','errors'=>'non si trova'],400);
            return $response;
        }
        //return View::make('index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    public function showCreateForm(){
        return View::make('new-person');
    }
    
    public function handleCreateToUse(Request $request){
        if($request->has('nome') and $request->has('cognome') and
        $request->has('telefono') and $request->has('addr_complete')){
            $array = $request->all();
                $datanascita = $request->input('datanascita');
                if($request->has('datanascita')){
                    $date = date_create_from_format('Y-m-d', $datanascita);
                }else{
                    $date = null;
                }
                if($request->has('email')){
                    $email = $request->input('email');
                }else{
                    $email = null;
                }
                $person = new App\Person([
                    'nome' => ucfirst(strtolower($request->input('nome'))),
                    'cognome'=> ucfirst(strtolower($request->input('cognome'))),
                    'email'=> $email,
                    'telefono'=> $request->input('telefono'),
                    'residenza'=> $request->input('addr_complete'),
                    'data_nascita'=> $date,
                ]);
            
            $person->save();   
            $id = $person->id;
            $nomecompleto = $person->nome.' '.$person->cognome;
            if($request->has('repair_after')){
            $data = array(
                'nome'=>$request->input('nome'),
                'cognome'=>$request->input('cognome'),
                'id'=>$id
                );
                $person = json_encode($data);
                $request->session()->put('selected-person', $person);
                return redirect('/select-repair-device');
            }else{
                return redirect('/home#ppl');
            }
        }else{
            return redirect()->back()->withInput();
        }
        
    }
    
    public function handleCreateNewPerson(Request $request){
        if($request->has('nome') and $request->has('cognome') and
        $request->has('telefono') and $request->has('addr_complete')){
            $array = $request->all();
            $datanascita = $request->input('datanascita');
            if($request->has('datanascita')){
                $date = date_create_from_format('Y-m-d', $datanascita);
            }else{
                $date = null;
            }
            if($request->has('email')){
                $email = $request->input('email');
            }else{
                $email = null;
            }
            $person = new App\Person([
                'nome' => ucfirst(strtolower($request->input('nome'))),
                'cognome'=> ucfirst(strtolower($request->input('cognome'))),
                'email'=> $email,
                'telefono'=> $request->input('telefono'),
                'residenza'=> $request->input('addr_complete'),
                'data_nascita'=> $date,
            ]);
            $person->save();   
            $id = $person->id;
            $nomecompleto = $person->nome.' '.$person->cognome;
            return redirect('/home#ppl'.$id);
        }
    }
    
    public function showFormCreateToUse(){
        return View::make('new-person')->with(['create2use' => 'yes']);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::check()){
            try{
                $match = ['id' => $id];
                $person = App\Person::where($match)->firstOrFail();
                    return View::make('person')->with(['nome' =>$person->nome,'cognome' =>$person->cognome]);
                //}
            }catch (ModelNotFoundException $ex) {
                // Error handling code
                return redirect('/home');//->action('PeopleConteoller@createToUse');
            }
            
        }
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
