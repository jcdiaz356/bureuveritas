<div>
    <div class="page-header">
        <div class="page-title">
            <h3>Listado OPS</h3>
        </div>
    </div>



    <div class="row layout-top-spacing">


        <div id="tableCaption" class="col-lg-12 col-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>OPS</h4>
                        </div>
                    </div>
                </div>

{{--                SEARCH  --}}
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-4 col-md-4 col-sm-12 col-12 ">
                            @include('common.searchbox')
                        </div>
                        <div class="col-xl-4 col-md-4 col-sm-12 col-12 ">
                            <div class="form-group">

                                <select id="inputSearchDesoist" wire:model.lazy="searchWareHouse" class="custom-select ">
                                    <option value="0">MOSTRAR TODO LOS DEPOSITOS</option>
                                    @foreach($warehouses as $warehouse)
                                        <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                                    @endforeach
                                </select>
                                @error('warehouse_id') <span class="text-danger er">{{$message}}</span> @enderror
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-4 col-sm-12 col-12 ">

{{--                        <button class="btn btn-primary mb-2 float-right">Nuevo</button>--}}
                            <a href="javascript:void()" type="button" class="btn btn-primary mb-2 float-right" data-toggle="modal" data-target="#theModal"  >
                                <i class="fas fa-plus"></i>
                                Nuevo
                            </a>
                        </div>
                    </div>
                </div>

{{--                AREA DE LA TABLA --}}
                <div class="widget-content widget-content-area">
                    <div class="table-responsive table-responsive-md table-responsive-lg  ">
                        <table id="table_services" class="table mb-4">
                            <caption>Lista de OPS</caption>
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Cód. OPS</th>
                                <th>Operación</th>
                                <th>Calidad</th>
                                <th>Cliente</th>
                                <th>Tipo Op. </th>
                                <th class="">Deposito</th>
                                <th>Concen.</th>
                                <th>Status</th>
                                <th>Tone.</th>
                                <th>Avance Ton.</th>
                                <th>Cant. Personal</th>
                                <th>Fecha Creación</th>
                                <th>Fecha Inicio Operación</th>
                                <th>User</th>
                                <th>Observación</th>
                                <th>Aciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($services as $service )
                                <tr>
                                    <td class="text-center">{{ $service->id }}</td>
                                    <td class="text-center">{{ $service->code_ops }}</td>
                                    <td class="text-primary">{{ $service->operation->name }}</td>
                                    <td class="text-center">{{ $service->calidad }}</td>
                                    <td class="text-center">
                                        @if (!is_null($service->customer_name))
                                            {{ $service->customer_name }}
{{--                                            {{ $service->customers }}--}}
                                          @endif
                                    </td>

                                    <td class="text-primary">{{ $service->subtype_operation_name }}</td>
                                    <td class="text-primary">{{ $service->warehouse->name }}</td>
                                    <td>{{ $service->concentrate_name }}</td>
{{--                                    <td>{{ $service->concentrate->name }}</td>--}}
                                    <td class="text-center">
{{--                                        <ul class="table-controls">--}}
{{--                                            <li> --}}
                                                <a href="javascript:void(0);"  wire:click.prevent="AddStatuDetail({{$service->id}})"
                                                   data-toggle="tooltip" data-placement="top" title="Añadir Avance"  >
                                                    @if ($service->statu->id == 1 )
                                                            <span class=" shadow-none badge  outline-badge-warning">
                                                                {{$service->statu->name}}
                                                            </span>
                                                    @endif
                                                    @if ($service->statu->id == 2 )
                                                        <span class=" shadow-none badge  outline-badge-success">
                                                            {{$service->statu->name}}
                                                        </span>
                                                    @endif
                                                    @if ($service->statu->id == 3 )
                                                        <span class=" shadow-none badge  outline-badge-danger">
                                                            {{$service->statu->name}}
                                                        </span>
                                                    @endif
                                                    @if ($service->statu->id == 4 )
                                                        <span class=" shadow-none badge  outline-badge-secondary">
                                                            {{$service->statu->name}}
                                                        </span>
                                                    @endif
                                                </a>
{{--                                            </li>--}}
{{--                                        </ul>--}}
                                    </td>
                                    <td class="text-center">{{$service->tonnage}}</td>
                                    <td class="text-center">

                                        <ul class="table-controls">
                                            <li>
                                                {{$service->total_tonnages}}
{{--                                                @if ($service->tonnage > $service->total_tonnages )--}}
                                                    <a href="javascript:void(0);" wire:click.prevent="AddTonnageDetail({{$service->id}})" data-toggle="tooltip" data-placement="top" title="Añadir Avance">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers">
                                                            <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
                                                            <polyline points="2 17 12 22 22 17"></polyline>
                                                            <polyline points="2 12 12 17 22 12"></polyline>
                                                        </svg>
                                                    </a>
{{--                                                @endif--}}
                                            </li>
                                        </ul>

                                    </td>
                                    <td class="text-center">{{$service->staff_amount}}</td>
                                    <td class="text-center">{{\Carbon\Carbon::parse($service->date_start)->format('d/m/Y')}}</td>
                                    <td class="text-center">{{\Carbon\Carbon::parse($service->date_start_operation)->format('d/m/Y')}}</td>
                                    <td class="text-center">{{ $service->user_name }}</td>
                                    <td class="text-center">{{ $service->observations }}</td>
                                    <td class="text-center">
                                        <ul class="table-controls">
                                            <li>
                                                <a href="javascript:void(0);" wire:click.prevent="Edit({{$service->id}})"  data-toggle="tooltip" data-placement="top" title="Editar">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2">
                                                        <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"
                                                        ></path>
                                                    </svg>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" onclick="Confirm('{{$service->id}}')" data-toggle="tooltip" data-placement="top" title="Eliminar">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                        <line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line>
                                                    </svg>
                                                </a>
                                            </li>

                                        </ul>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>


                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            {{ $services->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>


{{--        INCLUYENDO MODAL DE FORMULARIO --}}
        @include('livewire.services.form')

{{--        INCLUYENDO FORMULARIO PARA AÑADIR TONELAGE --}}
        @include('livewire.services.form-add-tonnage')

{{--        INCLUYENDO FORMULARIO PARA AÑADIR TONELAGE --}}
        @include('livewire.services.form-add-status')

    </div>
</div>

<script>

    document.addEventListener('DOMContentLoaded', function() {

       // console.log(moment().format('MMMM Do YYYY, h:mm:ss a'))
       // $('#date_register_form').val(moment().format('MMMM Do YYYY, h:mm:ss a'));
        //document.getElementById('date_register_form').value =



        //*** SECCIÓN MODAL DE SERVICIOS ******
        window.livewire.on('service-added', msg =>{
            $('#theModal').modal('hide');
            noty(msg)
        })
        window.livewire.on('service-update', msg =>{
            $('#theModal').modal('hide');
            noty(msg)
        })
        window.livewire.on('service-deleted', msg =>{
            noty(msg)
        })
        window.livewire.on('hide-modal', msg =>{
            $('#theModal').modal('hide');

        })
        window.livewire.on('show-modal', msg =>{
            $('#theModal').modal('show');

        })

        // OCULTANDO TODO LOS MENSAJES DE ERROR DEL FORMULARIO
        // window.livewire.on('hidden-modal', msg =>{
        //     $('.er').css('display','none');
        //
        // })
        $('#theModal').on('hidden.bs.modal',function(e){
            $('.er').css('display','none');
        });

        //*** END  ******


        //** SECTION MODAL TONNAGEL ******/

        window.livewire.on('show-modal-tonnage', msg =>{
            $('#theModalTonnage').modal('show');

        })

        window.livewire.on('tonnage-detail-save', msg =>{
            $('#theModalTonnage').modal('hide');
            noty(msg)
        })

        //*** END  ******

        //** SECTION MODAL TONNAGEL ******/

        window.livewire.on('show-modal-statu', msg =>{
            $('#theModalStatus').modal('show');

        })

        window.livewire.on('statu-detail-save', msg =>{
            $('#theModalStatus').modal('hide');
            noty(msg)
        })

        //*** END  ******



    });



    function Confirm(id){
       // console.log(id,service);
        // if(service > 0){
        //     swal('No se puede eliminar la categoria por que tiene productos relacionados')
        //     return;
        // }
        swal({
            title:'CONFIRMAR',
            text:'¿Confirmas eliminar la OPS?',
            type:'warning',
            showCancelButton:true,
            cancelButtonText:'Cerrar',
            cancelButtonColor:'#fff',
            confirmButtonText:'Aceptar',
            confirmButtonColor:'#3b3f5c'
        }).then(function (result){
            if(result.value){
                window.livewire.emit('deleteRow',id)
                swal.close()
            }
        })
    }



</script>
