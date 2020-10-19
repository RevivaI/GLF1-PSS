<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Pag2Controller extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $CantVer=$request->get('CantVer');
        
            return view('paw2')->with('CantV',$CantVer);

    }
    public function store2(Request $request)
    {
        $CantVer=$request->get('CantVer');
            return view('paw2')->with('CantV',$CantVer);

    }
    public function store3(Request $request)
    {   $a=$request->get('n1');
        $b=$request->get('n2');
        $CantV=$request->get('CantV');
        $CMatriz=$request->get('Arr');
            return view('paw3')->with('Matriz',$CMatriz)->with('CantV',$CantV)->with('a',$a)->with('b',$b);

    }
    public function storage(Request $request)
    {
        $CantV=$request->get('CantV');
        $CMatriz=$request->get('Arr');
            return view('paw4')->with('Matriz',$CMatriz,'CantV')->with('CantV',$CantV);
    }

    public function storage2(Request $request)
    {
        $CantV=$request->get('CantV');
        $CMatriz=$request->get('Arr');
          return view('paw5')->with('Matriz',$CMatriz,'CantV')->with('CantV',$CantV);
    }
}

