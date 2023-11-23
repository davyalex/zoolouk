@extends('admin.layouts.app')

@section('content')
    <!--start to page content-->
    {{-- @auth --}}
        <div class="page-content p-0 ">

            
            <div class="py-3 d-flex justify-content-between">
                <a class="btn btn-dark text-white py-3" onclick="history.go(-1)" href="#"><i data-feather="arrow-left"></i>Retour</a>
                <a class="btn btn-dark text-white py-3"" href="{{route('order.invoice',$orders['id'])}}"><i data-feather="file-text"></i>Facture</a>

            </div>
            <ul class="list-group list-group-flush rounded-0">

                <div class="fst-italic p-2 d-flex  justify-content-between">
                   <div>
                    <span class="text-dark fw-bold">Commande: #{{ $orders['code'] }} <span class="bg-dark text-white p-1">{{$orders['status']}} </span>  </span><br>
                    <span>Commandé le: {{ $orders['created_at']->format('d-m-Y') }} </span><br>
                    <span>Nbre articles: {{ $orders['quantity_product'] }} </span><br>
                    <span class="text-dark fw-bold">Total: {{ $orders['total'] }} </span><br>
                    <span>Méthode de paiement: {{ $orders['payement_method'] }} </span><br>

                   </div>
                    
                    <div class="fst-italic p-2">
                        <h6 class="p-2" style="background-color: #e1e6ea">Client</h6>
                       
                        <span>Client: {{ $orders['user']['name'] }} </span><br>
                        <span>Email: {{ $orders['user']['email'] }} </span><br>
                        <span>Téléphone: {{ $orders['user']['phone'] }} </span><br>
    
                    </div>

                </div>
                <h6 class="p-2" style="background-color: #e1e6ea">Articles commandés</h6>
                @foreach ($orders['products'] as $item)
                    <li class="list-group-item py-3">
                        <div class="d-flex flex-row align-items-start align-items-stretch gap-3">
                            <div class="product-img">
                                <a href="{{ route('product-detail', $item['id']) }}">
                                    <img src="{{ $item->getFirstMediaUrl('product_image') }}" class="rounded-3" width="100"
                                        alt=""></a>
                            </div>
                            <div class="product-info ml-3 ">
                                <h6 class="mb-1 text-dark">{{ $item['title'] }}</h6>
                                <div class="mt-1">
                                    <span
                                        class="fst-italic">{{ $item['pivot']['options'] && is_numeric($item['pivot']['options'][0]) ? 'Pointure: ' : ($item['pivot']['options'] && ctype_alpha($item['pivot']['options'][0]) ? 'Taille:' : '') }}
                                        {{ $item['pivot']['options'] }}</span><br>
                                    <span class="fst-italic">Qté :{{ $item['pivot']['quantity'] }} </span><br>
                                    <span class="fst-italic">Pu :{{ number_format($item['pivot']['unit_price']) }} FCFA
                                    </span>


                                </div>
                            </div>
                        </div>

                    </li>
                @endforeach

                <h6 class="p-2" style="background-color: #e1e6ea">Adresse de Livraison</h6>

                <div class="fst-italic p-2">
                    <span class="text-dark">#Livraison à domicile</span><br>
                    <span class="">Lieu de livraison: {{ $orders['delivery_name'] }} </span><br>
                    <span>Tarif livraison: {{ $orders['delivery_price'] }} </span><br>
                    <span>Client: {{ $orders['user']['name'] }} </span><br>

                </div>


                <h6 class="p-2" style="background-color: #e1e6ea">Expédition</h6>

                <div class="fst-italic p-2">
                    <span class="">Livraison prevue le :  {{ \Carbon\Carbon::parse($orders['delivery_planned'])->isoFormat('dddd D MMMM YYYY') }} </span><br>
                    <span class="">Date de livraison : {{ $orders['delivery_date']!==null ? \Carbon\Carbon::parse($orders['delivery_date'])->isoFormat('dddd D MMMM YYYY') : 'En attende livraison'  }} </span><br>

                </div>



        </div>
        <!--end to page content-->

    {{-- @endauth --}}
    <!--end to page content-->

@endsection

