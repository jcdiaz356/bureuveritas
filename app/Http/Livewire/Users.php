<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Users extends Component
{

    public $pageTitle;
    public $componentName;

    public $name;
    public $email;
    public $password;

    //Escuchando eventos desde el front end
    protected $listeners=[
        'deleteRow'=>'destroy'
    ];

    /**
     * Metodo que se inicia al cargar
     */
    public function mount(){

        $this->pageTitle = 'Listado';
        $this->componentName = 'Usuarios';
        // $this->subOperations =[];
    }


    /**
     * Añadiendo un nuevo servicio
     */
    public function Store(){

        $rules =[
            'name' => 'required|max:255',
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i|unique:users,email',
            'password' => 'required'
        ];

        $messages = [
            'name.required' => 'Ingrese su nombre',
            'name.max' => 'Maximo de 255 caracteres',
            'email.required' => 'Ingrese un correo electronico',
            'email.regex' => 'El correo electrónico no es correcto',
            'email.unique' => 'El correo ya se encuentra registrado',
            'password.required' => 'Ingrese una contraseña correcta',
        ];

        $this->validate($rules,$messages);


        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);


        $this->resetUI();
        $this->emit('user-added','usuario registrado correctamente');

    }
    public function render()
    {
        $users = User::all();
        return view('livewire.users.users',['users'=>$users])
            ->extends('layouts.theme.app')
            ->section('content') ;
    }

    /**
     * Resetea formulario
     */
    public function resetUI()
    {
        $this->name = null;
        $this->email = null;
        $this->password = null;


    }


    public function destroy(User $user){
        // dd($category);
        //$category = Category::find($category);



        $user->delete();

        $this->resetUI();
        $this->emit('service-deleted','Se eliminó el regisrtro');
    }


}
