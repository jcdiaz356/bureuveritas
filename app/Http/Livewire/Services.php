<?php

namespace App\Http\Livewire;

use App\Models\Concentrate;
use App\Models\Customer;
use App\Models\Operation;
use App\Models\Service;
use App\Models\Statu;
use App\Models\StatuDetail;
use App\Models\TonnageDetail;
use App\Models\WareHouse;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Services extends Component
{

    use WithPagination;


    protected $paginationTheme = 'bootstrap';

    //Services
    public $code_ops;
    public $calidad;
    public $customer_id;
    public $operation_id;
    public $operation_sub_type_id;
    public $warehouse_id;
    public $statu_id;
    public $concentrate_id;
    public $tonnage;
    public $staff_amount;
    public $date_start;
    public $date_start_operation;
    public $observations;

    //*** VARIABLES PARA AÑADIR TONAGEDETAIL***
    public $tonnageDetails = [];
    public $tonnageRest = 0;
    public $date_register = null;


//*** VARIABLES PARA AÑADIR STATUSDETAIL***
    public $statusDetails = [];

    public $search;
    public $searchWareHouse=0;
    public $selected_id;
    public $pageTitle;
    public $componentName;

    public $subOperations=[];

    private $pagination = 100 ;




    //Escuchando eventos desde el front end
    protected $listeners=[
        'deleteRow'=>'destroy'
    ];
    /**
     * Metodo que se inicia al cargar
     */
    public function mount(){

        $this->pageTitle = 'Listado';
        $this->componentName = 'OPS';


        $this->operation_id = 'Seleccionar operación';
        $this->customer_id = 'Seleccionar cliente';
        $this->operation_sub_type_id = null;
        $this->warehouse_id = 'Seleccionar depósito';
        $this->statu_id = 'Seleccionar estado';
        $this->concentrate_id = 'Seleccionar concentrado';

       // $this->subOperations =[];

    }


    /**
     * Listando servicio
     * @return mixed
     */
    public function render()
    {

        //dd($this->searchWareHouse);
        if(strlen($this->search) > 0 ) {
            $keyword=$this->search;
            $services = Service::select(
                'services.id',
                'services.code_ops',
                'services.calidad',
                'services.customer_id',
                'services.operation_id',
                'services.operation_sub_type_id',
                'services.warehouse_id',
                'services.statu_id',
                'services.concentrate_id',
                'services.tonnage',
                'services.staff_amount',
                'services.date_start',
                'services.observations',
                'services.date_start_operation',
                'operations.name',
                'customers.fullname as customer_name',
                'subtype_operation.name as subtype_operation_name',
                'concentrates.name as concentrate_name',
                'users.name as user_name',
                DB::raw('SUM(tonnages_details.tonnange) as total_tonnages')
            )
                ->leftJoin('operations','operations.id','=','services.operation_id')
                ->leftJoin('operations as subtype_operation','subtype_operation.id','=','services.operation_sub_type_id')
                ->leftJoin('warehouses','warehouses.id','=','services.warehouse_id')
                ->leftJoin('status','status.id','=','services.statu_id')
                ->leftJoin('concentrates','concentrates.id','=','services.concentrate_id')
                ->leftJoin('users','users.id','=','services.user_id')
                ->leftJoin('customers','customers.id','=','services.customer_id')
                ->leftJoin('tonnages_details','services.id','=','tonnages_details.service_id')
                ->where(function ($query) use($keyword){
                    $query->where('operations.name', "LIKE" ,"%$keyword%")
                        ->orWhere('services.code_ops', "LIKE", "%$keyword%");
                })
                ->SearchWarehouse($this->searchWareHouse)
                ->groupBy('services.id')
                ->paginate($this->pagination);

        } else {

            $services = Service::select(
                'services.id',
                'services.code_ops',
                'services.calidad',
                'services.customer_id',
                'services.operation_id',
                'services.operation_sub_type_id',
                'services.warehouse_id',
                'services.statu_id',
                'services.concentrate_id',
                'services.tonnage',
                'services.staff_amount',
                'services.date_start',
                'services.observations',
                'services.date_start_operation',
                'operations.name',
                'customers.fullname as customer_name',
                'subtype_operation.name as subtype_operation_name',
                'concentrates.name as concentrate_name',
                'users.name as user_name',
                DB::raw('SUM(tonnages_details.tonnange) as total_tonnages')

            )
                ->leftJoin('operations','operations.id','=','services.operation_id')
                ->leftJoin('operations as subtype_operation','subtype_operation.id','=','services.operation_sub_type_id')
                ->leftJoin('warehouses','warehouses.id','=','services.warehouse_id')
                ->leftJoin('status','status.id','=','services.statu_id')
                ->leftJoin('concentrates','concentrates.id','=','services.concentrate_id')
                ->leftJoin('users','users.id','=','services.user_id')
                ->leftJoin('tonnages_details','services.id','=','tonnages_details.service_id')
                ->leftJoin('customers','customers.id','=','services.customer_id')
                ->SearchWarehouse($this->searchWareHouse)
                ->groupBy('services.id')
                ->orderBy('services.id','desc')
                ->paginate($this->pagination);
        }

       // dd($services);

        $customers      = Customer::orderBy('fullname','asc')->get();
        $operations     = Operation::whereNull('parent_id')->orderBy('name','asc')->get();
       // $subOperations  = Operation::orderBy('name','asc')->get();
        $warehouses     = WareHouse::orderBy('name','asc')->get();
        $status         = Statu::orderBy('name','asc')->get();
        $concentrates   = Concentrate::orderBy('name','asc')->get();

        // dd($services);
        return view('livewire.services.services',[
            'services' => $services,
            'operations' => $operations,
            //'subOperations' => $subOperations,
            'warehouses' => $warehouses,
            'status' => $status,
            'concentrates' => $concentrates,
            'customers' => $customers
        ])
            ->extends('layouts.theme.app')
            ->section('content') ;;
    }

    /**
     * Paginación
     * @return string
     */
    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    /**
     * Añadiendo un nuevo servicio
     */
    public function Store(){

        // Creando reglas de validación
        $rules =[
            'code_ops' => 'required',
            'operation_id' => 'required|not_in:Seleccionar operación',
       //     'operation_sub_type_id' => 'required|not_in:Seleccionar',
            'warehouse_id' => 'required|not_in:Seleccionar depósito',
            'statu_id' => 'required|not_in:Seleccionar estado',
            'customer_id' => 'required|not_in:Seleccionar cliente',
            'concentrate_id' => 'required|not_in:Seleccionar concentrado',
            'tonnage' => 'required',
            'staff_amount' => 'required',
            'date_start' => 'required',
            'date_start_operation' => 'required'
        ];

        $messages = [
            'code_ops.required' => 'Ingrese el código OPS',
            'operation_id.not_in' => 'Seleccione una operación',
         //   'operation_sub_type_id.not_in' => 'Seleccione una sub opción',
            'warehouse_id.not_in' => 'Seleccione un deposito',
            'statu_id.not_in' => 'Seleccione el estado',
            'customer_id.not_in' => 'Seleccionar cliente',
            'concentrate_id.not_in' => 'Seleccione concentrado',
            'tonnage.required' => 'Ingrese el tonelage',
            'staff_amount.required' => 'Ingrese la cantidad',
            'date_start.required' => 'Ingrese la fecha de inicio',
            'date_start_operation.required' => 'Ingrese la fecha fin de operación'
        ];

        $this->validate($rules,$messages);


        $user_id = Auth::user()->id;
        $service = Service::create([
               'code_ops'               => $this->code_ops,
               'calidad'                => $this->calidad,
               'customer_id'            => $this->customer_id,
               'operation_id'           => $this->operation_id,
               'operation_sub_type_id'  => $this->operation_sub_type_id,
               'warehouse_id'           => $this->warehouse_id,
               'statu_id'               => $this->statu_id,
               'user_id'                => $user_id,
               'concentrate_id'         => $this->concentrate_id,
               'tonnage'                => $this->tonnage,
               'staff_amount'           => $this->staff_amount,
               'date_start'             => $this->date_start,
               'date_start_operation'   => $this->date_start_operation,
               'observations'           => $this->observations
        ]);
        $service->save();

        StatuDetail::create([
            'service_id' => $service->id,
            'statu_id' => $this->statu_id,
            'user_id' => $user_id ,
            'date_register' => $this->date_start
        ]);



        $this->resetUI();
        $this->emit('service-added','Ops registrado correctamente');

    }

    /**
     * Editando el servicio que es enviado por el frontEnd desde el formulario
     * @param Service $service
     */
    public function Edit(Service $service){

        $this->selected_id = $service->id;
        $this->code_ops    = $service->code_ops;
        $this->customer_id = $service->customer_id;
        $this->operation_id = $service->operation_id;

        $this->warehouse_id = $service->warehouse_id;
        $this->statu_id = $service->statu_id;
       // $user_id = $service->user_id;
        $this->concentrate_id = $service->concentrate_id;
        $this->tonnage = $service->tonnage;
        $this->staff_amount = $service->staff_amount;
        $this->date_start = $service->date_start;
        $this->date_start_operation = $service->date_start_operation;

        $this->subOperations  = Operation::where('parent_id','=',$service->operation_id)->orderBy('name','asc')->get();
        $this->operation_sub_type_id = $service->operation_sub_type_id;
        $this->observations = $service->observations;


        $this->emit('show-modal','show modal');
    }



    public function Update(){

        $rules =[
            'code_ops' => 'required',
            'operation_id' => 'required|not_in:Seleccionar operación',
            'customer_id' => 'required|not_in:Seleccionar cliente',
          //  'operation_sub_type_id' => 'required|not_in:Seleccionar',
            'warehouse_id' => 'required|not_in:Seleccionar depósito',
            'statu_id' => 'required|not_in:Seleccionar estado',
            'concentrate_id' => 'required|not_in:Seleccionar concentrado',
            'tonnage' => 'required',
            'staff_amount' => 'required',
            'date_start' => 'required',
            'date_start_operation' => 'required'
        ];

        $messages = [
            'code_ops.required' => 'Ingrese código ops',
            'operation_id.not_in' => 'Seleccione una operación',
            'customer_id.not_in' => 'Seleccionar cliente',
          //  'operation_sub_type_id.not_in' => 'Seleccione una sub opción',
            'warehouse_id.not_in' => 'Seleccione un depósito',
            'statu_id.not_in' => 'Seleccione el estado',
            'concentrate_id.not_in' => 'Seleccione concentrado',
            'tonnage.required' => 'Ingrese el tonelage',
            'staff_amount.required' => 'Ingrese la cantidad',
            'date_start.required' => 'Ingrese la fecha de inicio',
            'date_start_operation.required' => 'Ingrese la fecha fin de operación'
        ];

        $this->validate($rules,$messages);


        $user_id = Auth::user()->id;
        $service = Service::find($this->selected_id);
        $service->update(
            [
                'code_ops'               => $this->code_ops,
                'calidad'                => $this->calidad,
                'operation_id'           => $this->operation_id,
                'customer_id'            => $this->customer_id,
                'operation_sub_type_id'  => $this->operation_sub_type_id,
                'warehouse_id'           => $this->warehouse_id,
                'statu_id'               => $this->statu_id,
                'user_id'                => $user_id,
                'concentrate_id'         => $this->concentrate_id,
                'tonnage'                => $this->tonnage,
                'staff_amount'           => $this->staff_amount,
                'date_start'             => $this->date_start,
                'date_start_operation'   => $this->date_start_operation,
                'observations'           => $this->observations
            ]
        );


        $this->resetUI();
        $this->emit('service-update','Categoría actualizada');


    }


    // Formulario para añadir nuevo tonelage
    public function AddTonnageDetail(Service $service){

        $this->pageTitle = 'Añadir tonelage';
        $this->componentName = 'Tonelage';

        $this->selected_id = $service->id;
        $this->tonnageDetails = TonnageDetail::where('service_id','=',$service->id)->get();

        $tonnage_avance = TonnageDetail::select(DB::raw('SUM(tonnange) as tonnage_avance'))
        ->where('service_id','=',$service->id)
        ->groupBy('service_id')->first();
        //dd($tonnage_avance);
        if($tonnage_avance == null ){
            $tonnage_avance = 0;
        } else {
            $tonnage_avance = $tonnage_avance->tonnage_avance;
        }

        $this->tonnageRest = $service->tonnage - $tonnage_avance ;

        $this->emit('show-modal-tonnage','show modal'); //Emitiendo un evento para ser escuchado en frontend y abrir ventana modal
        $this->emit('add-date-client','show modal'); // Emitiendo un evento para ser escuchado en el frontend y coloca la fecha en input hiden
    }

    public function SaveTonnageDetail(){

        $rules =[
            'tonnageRest' => 'required',
        ];

        $messages = [
            'tonnageRest.required' => 'Ingresar el tonelage de avance',
        ];

        $this->validate($rules,$messages);

        $user_id = Auth::user()->id;
        $service = TonnageDetail::create([
            'service_id'            => $this->selected_id,
            'tonnange'              => $this->tonnageRest,
            'date_register'         => Carbon::now(),
            'user_id'               => $user_id
        ]);
        $service->save();

        $this->resetTonnageUI();
        $this->emit('tonnage-detail-save','Ops registrado correctamente');


    }


    // Formulario para añadir nuevo tonelage
    public function AddStatuDetail(Service $service){

        $this->pageTitle = 'Añadir nuevo estado';
        $this->componentName = 'Estado';

        $this->selected_id = $service->id;

        $this->statusDetails = StatuDetail::select(
            'status.name',
            'status_details.date_register',
        )
            ->leftJoin('status','status.id','=','status_details.statu_id')
            ->where('status_details.service_id',"=",$service->id)
            ->get();


        $this->emit('show-modal-statu','show modal'); //Emitiendo un evento para ser escuchado en frontend y abrir ventana modal
    }

    public function SaveStatuDetail(){

        $rules =[
            'statu_id' => 'required|not_in:Seleccionar estado',
        ];

        $messages = [
            'statu_id.not_in' => 'Seleccione el estado',
        ];

        $this->validate($rules,$messages);

        $user_id = Auth::user()->id;
        $statuDetail = StatuDetail::create([
            'service_id'            => $this->selected_id,
            'statu_id'              => $this->statu_id,
            'date_register'         => Carbon::now(),
            'user_id'               => $user_id
        ]);
        $statuDetail->save();

        $service = Service::find($this->selected_id);
        $service->statu_id = $this->statu_id;
        $service->save();

        $this->resetStatuUI();
        $this->emit('statu-detail-save','Ops registrado correctamente');


    }

    /**
     * Resetea formulario de Nuevo servicios
     */
    public function resetUI()
    {
        $this->selected_id = 0;
        $this->code_ops = null;
        $this->operation_id = "Seleccionar operación";
        $this->customer_id = "Seleccionar cliente";
        $this->operation_sub_type_id = null;
        $this->warehouse_id = "Seleccionar depósito";
        $this->statu_id = "Seleccionar estado";
        $this->concentrate_id = "Seleccionar concentrado";
        $this->tonnage = "";
        $this->staff_amount = "";
        $this->date_start = "";
        $this->date_start_operation = "";
        $this->observations = "";
        $this->subOperations = [];

    }

    /**
     * Resetea formulario de añadir tonelage
     */
    public function resetTonnageUI()
    {
        $this->pageTitle = '';
        $this->componentName = '';

        $this->selected_id = null;

        $this->tonnageDetails = [];
        $this->tonnageRest =0;
        $this->date_register = null;

    }

    public function resetStatuUI()
    {
        $this->pageTitle = '';
        $this->componentName = '';

        $this->selected_id = null;

    }

    public function subOptionsSelected($id){

        $this->subOperations  = Operation::where('parent_id','=',$id)->orderBy('name','asc')->get();
       // dd($id);
       // $this->subOptions = [$id];

        //$this->emit('show-modal','show modal');
    }

    public function destroy(Service $service){
        // dd($category);
        //$category = Category::find($category);

        StatuDetail::where('service_id','=',$service->id)->delete();

        TonnageDetail::where('service_id','=',$service->id)->delete();

        $service->delete();

        $this->resetUI();
        $this->emit('service-deleted','Se eliminó el regisrtro');
    }
}
