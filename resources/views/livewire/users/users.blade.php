<div>
    <div class="page-header">
        <div class="page-title">
            <h3>Listado Usuarios</h3>
        </div>
    </div>


    <div class="row layout-top-spacing">


        <div id="tableCaption" class="col-lg-12 col-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Usuarios</h4>
                        </div>
                    </div>
                </div>

                {{--                SEARCH  --}}
                <div class="widget-header">
                    <div class="row">


                        <div class="col-xl-4 col-md-4 col-sm-12 col-12 ">

                            {{--                        <button class="btn btn-primary mb-2 float-right">Nuevo</button>--}}
                            <a href="javascript:void()" type="button" class="btn btn-primary mb-2 float-left" data-toggle="modal" data-target="#theModalUser">
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
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Aciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user )
                                <tr>
                                    <td class="text-center">{{ $user->id }}</td>
                                    <td class="text-center">{{ $user->name }}</td>
                                    <td class="text-primary">{{ $user->email }}</td>


                                    <td class="text-center">
                                        <ul class="table-controls">

                                            @if (Auth::user()->id != $user->id)
                                                <li>
                                                    <a href="javascript:void(0);" onclick="Confirm('{{$user->id}}')" data-toggle="tooltip" data-placement="top" title="Eliminar">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
                                                            <polyline points="3 6 5 6 21 6"></polyline>
                                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                            <line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line>
                                                        </svg>
                                                    </a>
                                                </li>
                                            @endif


                                        </ul>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>



            </div>
        </div>


        {{--        INCLUYENDO MODAL DE FORMULARIO ADD USER --}}
        @include('livewire.users.form-add-user')

    </div>

</div>

<script>

    document.addEventListener('DOMContentLoaded', function() {

        // console.log(moment().format('MMMM Do YYYY, h:mm:ss a'))
        // $('#date_register_form').val(moment().format('MMMM Do YYYY, h:mm:ss a'));
        //document.getElementById('date_register_form').value =



        //*** SECCIÓN MODAL DE SERVICIOS ******
        window.livewire.on('user-added', msg =>{
            $('#theModalUser').modal('hide');
            noty(msg)
        })

        window.livewire.on('service-deleted', msg =>{
            noty(msg)
        })
        window.livewire.on('hide-modal', msg =>{
            $('#theModalUser').modal('hide');

        })
        window.livewire.on('show-modal', msg =>{
            $('#theModalUser').modal('show');

        })

        // OCULTANDO TODO LOS MENSAJES DE ERROR DEL FORMULARIO
        // window.livewire.on('hidden-modal', msg =>{
        //     $('.er').css('display','none');
        //
        // })
        $('#theModalUser').on('hidden.bs.modal',function(e){
            $('.er').css('display','none');
        });

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
            text:'¿Confirmas eliminar el usuario?',
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
