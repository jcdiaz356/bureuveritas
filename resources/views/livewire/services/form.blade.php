@include('common.modalHead')

<div class="row">
    <div class="col-12">

        <div class="form-row mb-1">
            <div class="form-group col-md-6 col-6">
                <label for="code_ops">Código OPS</label>
                <input id="code_ops" type="text" wire:model.lazy="code_ops" class="form-control" placeholder=""  autocomplete="off">
                @error('code_ops') <span class="text-danger er">{{$message}}</span> @enderror
            </div>

        </div>

        <div class="form-row mb-1">
            <div class="form-group col-md-6 col-6">
                <label for="calidad">Calidad</label>
                <input id="calidad" type="text" wire:model.lazy="calidad" class="form-control" placeholder=""  autocomplete="off">

            </div>
            <div class="form-group col-md-6 col-6">
                <div class="form-group col-md-6 col-6">
                    <label for="inputDeposito">Cliente</label>
                    <select id="inputDeposito" wire:model.lazy="customer_id" class="custom-select ">
                        <option selected disabled>Seleccionar cliente</option>
                        @foreach($customers as $customer)
                            <option value="{{$customer->id}}">{{$customer->fullname}}</option>
                        @endforeach
                    </select>
                    @error('customer_id') <span class="text-danger er">{{$message}}</span> @enderror
                </div>
            </div>
        </div>


            <div class="form-row mb-1">
                <div class="form-group col-md-6 col-6">
                    <label for="slectOperation">Operacion</label>
                    <select id="slectOperation"  wire:model="operation_id" wire:change="subOptionsSelected($event.target.value)"  class="custom-select">
                        <option selected disabled>Seleccionar operación</option>
                        @foreach($operations as $operation)
                            <option value="{{$operation->id}}">{{$operation->name}}</option>
                        @endforeach
                    </select>
                    @error('operation_id') <span class="text-danger er">{{$message}}</span> @enderror
                </div>
                <div class="form-group col-md-6 col-6">
                    <label for="slectSubOperation">Sub Operacion</label>


                    <select id="slectSubOperation"  wire:model.lazy="operation_sub_type_id" class="custom-select ">
                        <option value="null" selected disabled>Seleccionar</option>
                        @foreach($subOperations as $subOperation)
                            <option value="{{$subOperation->id}}">{{$subOperation->name}}</option>
                        @endforeach
                    </select>
                    @error('operation_sub_type_id') <span class="text-danger er">{{$message}}</span> @enderror
                </div>
            </div>


            <div class="form-row mb-1">
                <div class="form-group col-md-6 col-6">
                    <label for="inputDeposito">Depósito</label>
                    <select id="inputDeposito" wire:model.lazy="warehouse_id" class="custom-select ">
                        <option selected disabled>Seleccionar depósito</option>
                        @foreach($warehouses as $warehouse)
                            <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                        @endforeach
                    </select>
                    @error('warehouse_id') <span class="text-danger er">{{$message}}</span> @enderror
                </div>
                <div class="form-group col-md-6 col-6">
                    <label for="inputComment">Concentrado</label>
                    <select id="inputComment" wire:model.lazy="concentrate_id"  class="custom-select ">
                        <option selected disabled>Seleccionar concentrado</option>
                        @foreach($concentrates as $concentrate)
                            <option value="{{$concentrate->id}}">{{$concentrate->name}}</option>
                        @endforeach
                    </select>
                    @error('concentrate_id') <span class="text-danger er">{{$message}}</span> @enderror
                </div>
            </div>

            <div class="form-row mb-1">
                <div class="form-group col-md-6 col-6">
                    <label   for="selectEstado">Estado</label>
                    <select id="selectEstado"  wire:model.lazy="statu_id"  class="custom-select">
                        <option selected disabled>Seleccionar estado</option>
                        @foreach($status as $statu)
                            <option value="{{$statu->id}}">{{$statu->name}}</option>
                        @endforeach
                    </select>
                    @error('statu_id') <span class="text-danger er">{{$message}}</span> @enderror
                </div>
                <div class="form-group col-md-6 col-6">
                    <label for="tonelageNumber">Tonelage</label>
                    <input id="tonelageNumber" type="number" wire:model.lazy="tonnage" class="form-control" placeholder="Ejemplo: 20">
                    @error('tonnage') <span class="text-danger er">{{$message}}</span> @enderror
                </div>
            </div>

            <div class="form-row mb-1">


                <div class="form-group col-md-6 col-6">
                    <label for="personalNumber">Personal</label>
                    <input id="personalNumber" type="number" wire:model.lazy="staff_amount" class="form-control" placeholder="Ejemplo:">
                    @error('staff_amount') <span class="text-danger er">{{$message}}</span> @enderror
                </div>
                <div class="form-group col-md-6 col-6">
                    <label for="dateStarFlatpickr">Fecha Inicio</label>
                    <input id="dateStarFlatpickr" type="text" wire:model.lazy="date_start" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Seleccionar fecha.."  autocomplete="off">
                    @error('date_start') <span class="text-danger er">{{$message}}</span> @enderror
                </div>
            </div>




            <div class="form-row mb-1">


                <div class="form-group col-md-6 col-6">
                    <label for="dateOperationFlatpickr">Fecha Inicio Operación</label>
                    <input id="dateOperationFlatpickr" type="text" wire:model.lazy="date_start_operation"  class="form-control flatpickr flatpickr-input active" type="text" placeholder="Select Date.."  autocomplete="off">
                    @error('date_start_operation') <span class="text-danger er">{{$message}}</span> @enderror
                </div>
            </div>

            <div class="form-row mb-1">


                <div class="form-group col-md-6 col-6">

                    <div class="form-group mb-4">
                        <label for="observations">Observaciones</label>
                        <textarea class="form-control"  wire:model.lazy="observations"  id="observations" rows="3"></textarea>
                    </div>
{{--                    <label for="dateOperationFlatpickr">Fecha Inicio Operación</label>--}}
{{--                    <input id="dateOperationFlatpickr" type="text" wire:model.lazy="date_start_operation"  class="form-control flatpickr flatpickr-input active" type="text" placeholder="Select Date.."  autocomplete="off">--}}

                </div>
            </div>

    </div>





{{--    <div class="col-sm-12">--}}
{{--        <div class="input-group">--}}
{{--            <div class="input-group-prepend">--}}
{{--                <span class="input-group-text">--}}
{{--                    <span class="fas fa-edit">--}}
{{--                        ♫--}}
{{--                    </span>--}}
{{--                </span>--}}
{{--            </div>--}}
{{--            <input type="text" wire:model.lazy="name" class="form-control" placeholder="ej: Cursos">--}}
{{--        </div>--}}
{{--        @error('name') <span class="text-danger er">{{$message}}</span> @enderror--}}
{{--    </div>--}}



</div>
@include('common.modalFooter')

<script>
    document.addEventListener('DOMContentLoaded', function() {

        //APLICANDO DATAPICKER A LOS CONTROLES
        var f1 = flatpickr(document.getElementById('dateOperationFlatpickr'));
        var f2 = flatpickr(document.getElementById('dateStarFlatpickr'));


        // PLICANDO MASCARA A LOSINPUTS
        // $("#tonelageNumber").inputmask({mask:"99999"});
        // $("#personalNumber").inputmask({mask:"999"});
    });


</script>
