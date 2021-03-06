<!-- Modal -->
<div wire:ignore.self class="modal fade" id="theModalStatus"  data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title " id="exampleModalLabel">
                    <b>{{$componentName}}</b> | {{$pageTitle}}
                </h5>
                {{--                <h6 class="text-center text-warning" wire:loading>--}}
                {{--                    Por favor espere--}}
                {{--                </h6>--}}
                <div  wire:loading class="text-warning" >
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-loader spin mr-2 text-warning">
                        <line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line>
                        <line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line>
                        <line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line>
                        <line x1="2" y1="12" x2="6" y2="12"></line>
                        <line x1="18" y1="12" x2="22" y2="12"></line>
                        <line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line>
                        <line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line>
                    </svg>
                    Por favor espere...
                </div>


            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-row mb-1">
                            <div class="form-group col-md-6 col-6">
                                <label   for="selectEstado">Estado</label>
                                <select id="selectEstado"  wire:model.defer="statu_id"  class="custom-select">
                                    <option selected disabled>Seleccione el estado</option>
                                    @foreach($status as $statu)
                                        <option value="{{$statu->id}}">{{$statu->name}}</option>
                                    @endforeach
                                </select>
                                @error('statu_id') <span class="text-danger er">{{$message}}</span> @enderror
                            </div>

                            <div class="form-group col-md-6 col-6">
                                <h6>Informaci??n</h6>

                                    @foreach($statusDetails as $statuDetail )
                                    <p>
                                      <b>Estado:</b>   {{$statuDetail->name}} |   <b>Fecha:</b>  {{$statuDetail->date_register}}
                                    </p>
                                    @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="resetStatuUI()" class="btn btn-dark close-btn text-info" data-dismiss="modal">
                    <i class="fas fa-times"></i>
                    Cancelar
                </button>
                <button type="button" wire:click.prevent="SaveStatuDetail()" class="btn btn-dark close-modal" >
                    <i class="fas fa-save"></i>
                    GUARDAR
                </button>
            </div>
        </div>
    </div>
</div>

<script>

    document.addEventListener('DOMContentLoaded', function() {
        window.livewire.on('add-date-client', msg =>{
            $('#date_register_form').val(moment().format('Y-MM-DD h:mm:ss'));
        })

    })
</script>

