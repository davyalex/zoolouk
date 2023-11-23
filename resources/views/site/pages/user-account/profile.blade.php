@extends('site.layouts.app')

@section('title', 'Mon profile')

@section('content')
   @auth
   <div class="page-content">

    <div class="profile-img mb-3 border p-3 text-center rounded-3 bg-light">
        <img src="{{Auth::user()->avatar ? Auth::user()->avatar : asset('assets/images/avatars/avatar.png')}}" width="90" height="90" class="rounded-circle" alt="">
        <h6 class="mb-0 fw-bold mt-3 text-dark">{{Auth::user()->name}}</h6>
    </div>

    <div class="card rounded-3 border-0 bg-transparent">
        <div class="card-body p-0">
          @include('admin.components.validationMessage')
          <form class="mt-4 needs-validation" method="POST" action="{{ route('my-profile-update', Auth::user()->id) }}" novalidate>
            @csrf
            <div class="row row-cols-1 g-3">
                    <div class="col">
                        <d]iv class="form-floating">
                            <input type="text" class="form-control rounded-3" id="floatingInputName"
                                placeholder="Name" name="name" value="{{Auth::user()->name}}" required>
                            <label for="floatingInputName">Nom & Prenoms</label>
                        </d>
                    </div>
                    <div class="col">
                        <div class="form-floating">
                            <input type="text" name="phone" class="form-control rounded-3" max="10" id="floatingInputNumber"
                                placeholder="Name" value="{{Auth::user()->phone ? Auth::user()->phone : 'non defini' }}">
                            <label for="floatingInputNumber">Contact</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating">
                            <input type="text" class="form-control rounded-3" id="floatingInputEmail"
                                placeholder="Email" name="email" value="{{Auth::user()->email ? Auth::user()->email : '' }}">
                            <label for="floatingInputEmail">Email</label>
                        </div>
                        <input type="text" name="url_previous" value="{{url()->previous()}}" hidden>
                    </div>
                    {{-- <div class="col">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1"
                                value="option1" checked>
                            <label class="form-check-label" for="inlineRadio1">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2"
                                value="option2">
                            <label class="form-check-label" for="inlineRadio2">Female</label>
                        </div>
                    </div> --}}
                    {{-- <div class="col">
                        <div class="form-floating">
                            <input type="date" class="form-control rounded-3" id="floatingInputDOB" value="">
                            <label for="floatingInputDOB">Date of Birth</label>
                        </div>
                    </div> --}}
                    {{-- <div class="col">
                        <div class="form-floating">
                            <input type="text" class="form-control rounded-3" id="floatingInputLocation"
                                placeholder="Location" value="United Kingdom">
                            <label for="floatingInputLocation">Location</label>
                        </div>
                    </div> --}}
                    <div class="mb-0 d-grid">
                      <button type="submit" class="btn btn-dark btn-ecomm rounded-3">Modifier</button>
                  </div>
                </div>
            </form>
        </div>
    </div>

</div>
   @endauth
    <!--end to page content-->
@endsection
