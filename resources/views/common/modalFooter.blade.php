
    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click.prevent="resetUI()" class="btn btn-dark close-btn text-info" data-dismiss="modal">
                            <i class="fas fa-times"></i>
                            Cancelar
                        </button>
                    @if ($selected_id < 1)
                        <button type="button" wire:click.prevent="Store()" class="btn btn-dark close-modal" >
                            <i class="fas fa-save"></i>
                            GUARDAR
                        </button>
                    @else
                        <button type="button" wire:click.prevent="Update()" class="btn btn-dark close-modal" >
                            <i class="fas fa-save"></i>
                            ACTUALIZAR
                        </button>

                     @endif
            {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button> --}}
                    </div>
                </div>
            </div>
    </div>
