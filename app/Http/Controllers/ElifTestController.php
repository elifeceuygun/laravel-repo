<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chirp;

class ElifTestController extends Controller
{
    public function index(){
        //dd('hello this is Elif');
        //return 'Hello, World! im learning php';
        //return view('chirps.index');
        return view('chirps.index', [
            'chirps' => Chirp::with('user')->latest()->get(),
        ]);
        
        }
        
    
        public function store(Request $request)
        {
            //
            $validated = $request->validate([
                'message' => 'required|string|max:255',
            ]);
     
            $request->user()->chirps()->create($validated);
     
            return redirect(route('chirps.index'));
        }

        public function edit(Chirp $chirp)
        {
        $this->authorize('update', $chirp);
 
        return view('chirps.edit', [
            'chirp' => $chirp,
        ]);
        
        }

        public function update(Request $request, Chirp $chirp)
        {
            $this->authorize('update', $chirp);
 
            $validated = $request->validate([
                'message' => 'required|string|max:255',
            ]);
     
            $chirp->update($validated);
     
            return redirect(route('chirps.index'));
        
        }

        public function destroy(Chirp $chirp)
        {
            $this->authorize('delete', $chirp);
 
            $chirp->delete();
     
            return redirect(route('chirps.index'));
        }
    

}


/*{
    public function index(){


    return 'Hello, World!';
    return view('chirps.index');
    
    }
}
*/


