@extends('layouts.admin')

@section('content')
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-md-12">
                <h1>Dettagli Appartamento</h1>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6 col-xl-4 mb-4">
                <div class="card h-100">
                    {{-- header --}}
                    <div class="card-header">
                        {{ $apartment->title }}
                    </div>
                    {{-- body --}}
                    <div class="card-body">
                        <img src="{{ $apartment['principal_image'] ? asset('storage/' . $apartment->principal_image) : 'https://www.signfix.com.au/wp-content/uploads/2017/09/placeholder-600x400.png' }}"
                            class="card-img-top" alt="{{ $apartment->title }}">
                        {{-- text --}}
                        <div class="card-tex py-3">
                            <p><strong>Descrizione :</strong> {{ $apartment->description }} </p>
                            <p><strong>Indirizzo:</strong> {{ $apartment->address }} </p>
                            <p><strong>Città :</strong> {{ $apartment->city }} </p>
                            <p><strong>Paese :</strong> {{ $apartment->country }} </p>
                            <p><strong>Prezzo :</strong> {{ $apartment->price }} </p>
                            <p><strong>Stanze :</strong> {{ $apartment->num_rooms }}</p>
                            <p><strong>Bagno :</strong> {{ $apartment->num_bathrooms }} </p>
                            <p><strong>Metri Quandri :</strong> {{ $apartment->square_meters }} mq</p>
                            <p><strong>Servizi</strong></p>
                            <ul>
                                @foreach ($apartment->services as $service)
                                    <li>{{ $service->name_service }}</li>
                                @endforeach
                            </ul>
                            {{-- @foreach ($apartment->serviceID as $service)
                                    {{ $service->serviceID }}{{ $loop->last ? '' : ', ' }}
                                @endforeach --}}

                            <p><strong>Visibilità :</strong> {{ $apartment->visible ? 'Yes' : 'No' }} </p>
                        </div>
                        {{-- footer --}}
                        <div class="card-footer">
                            {{-- link to show apartment id {{ $apartment->id }} --}}
                            <a href="{{ route('admin.apartments.edit', $apartment->id) }}"
                                class="btn btn-primary">Modifica</a>
                            {{-- form per la cancellazione + pop up --}}
                            <form id="deleteForm" action="{{ route('admin.apartments.destroy', $apartment) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')

                                <button id="deleteButton" class="btn btn-danger" type="button">Cancella Elemento</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButton = document.getElementById('deleteButton');
            const deleteForm = document.getElementById('deleteForm');

            deleteButton.addEventListener('click', function() {
                // Mostra un popup di conferma
                const confirmDelete = confirm("Sei sicuro di voler eliminare l'elemento selezionato?");

                if (confirmDelete) {
                    // Invia il modulo per la cancellazione
                    deleteForm.submit();
                } else {
                    console.log("Cancellazione annullata.");
                }
            });
        });
    </script>
@endsection
