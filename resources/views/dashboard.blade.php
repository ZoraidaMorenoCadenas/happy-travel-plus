<x-app-layout>
    <!--<div class="grid-container">
        @foreach ($form_add_new_cards as $form_add_new_card)

        <div class="card-container">
            <div class="img-container">
                <img class="image-card" src="{{ asset('storage/' . $form_add_new_card->image) }}" alt="Image">
            </div>
            <div class="container-ud">
                <div class="text-container">
                    <p class="dashboard-title">{{ $form_add_new_card->title }}</p>
                    <p class="dashboard-location">{{ $form_add_new_card->location }}</p>
                </div>

                @if ($form_add_new_card->user->is(auth()->user()))


                <a href="{{ route('details', $form_add_new_card) }}" class="icon-info">
                    <img class="info" src="{{ asset('assets/Info-icon.svg') }} " alt="Mostrar mas info"></a>

                <div class="icons-ud">
                    <a href="{{ route('formAddNewCard.edit', $form_add_new_card) }}"
                        class="text-indigo-600 hover:text-indigo-900"><img src="{{ asset('assets/Edit-icon.svg') }}"
                            alt="Editar"></a>
                    <button type="button" class="" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <img src="{{ asset('assets/Delete-icon.svg') }}" alt="Borrar">
                    </button>
                </div>
            </div>

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-width">
                    <div class="modal-content rounded-4">
                        <div class="modal-body rounded-4">
                            <p>¿Quieres eliminar este destino?</p>
                            <div class="buttons">
                                <form method="POST" action="{{ route('formAddNewCard.destroy', $form_add_new_card) }}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="rounded-pill btn-accept button"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                        Aceptar
                                    </button>
                                </form>
                                <button type="button" class="btn-cancel button rounded-pill"
                                    data-bs-dismiss="modal">Cancelar</button>
                            </div>
                        </div>

                    </div>
                </div>

                @endif

            </div>

        </div>
        @endforeach -->

        @foreach ($cards as $card)
        <div class="card-container">
            <div class="img-container">
                <img class="image-card" src="{{ $card->image }}" alt="{{ $card->title }}">
            </div>
            <div class="text-container-card">
                <h3 class="dashboard-title">{{ $card->title }}</h3>
                <h4 class="dashboard-location">{{ $card->location }}</h4>
            </div>
        </div>
        @endforeach

    </div>

    @if ($card->user->is(auth()->user()))


                <a href="{{ route('details', $card) }}" class="icon-info">
                    <img class="info" src="{{ asset('assets/Info-icon.svg') }} " alt="Mostrar mas info"></a>

                <div class="icons-ud">
                    <a href="{{ route('formAddNewCard.edit', $card) }}"
                        class="text-indigo-600 hover:text-indigo-900"><img src="{{ asset('assets/Edit-icon.svg') }}"
                            alt="Editar"></a>
                    <button type="button" class="" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <img src="{{ asset('assets/Delete-icon.svg') }}" alt="Borrar">
                    </button>
                </div>
            </div>

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-width">
                    <div class="modal-content rounded-4">
                        <div class="modal-body rounded-4">
                            <p>¿Quieres eliminar este destino?</p>
                            <div class="buttons">
                                <form method="POST" action="{{ route('formAddNewCard.destroy', $card) }}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="rounded-pill btn-accept button"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                        Aceptar
                                    </button>
                                </form>
                                <button type="button" class="btn-cancel button rounded-pill"
                                    data-bs-dismiss="modal">Cancelar</button>
                            </div>
                        </div>

                    </div>
                </div>

                @endif

            </div>

        </div>
       <!-- @endforeach-->

</x-app-layout>