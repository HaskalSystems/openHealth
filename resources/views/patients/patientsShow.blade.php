@extends('layouts.app')

@section('content')
    <a href="#" data-toggle="push-menu" class="paper-nav-toggle left ml-2 fixed">
        <i></i>
    </a>
    <div class="has-sidebar-left has-sidebar-tabs">
        @include('components.searchbar')
        <div class="sticky">
            <div class="navbar navbar-expand d-flex justify-content-between bd-navbar white">
                <div class="relative">
                    <div class="d-flex">
                        <div class="d-none d-md-block">
                            <h1 class="nav-title @if(env('DARKTHEME')==false) text-black @endif">Patient - {{$patients->name}}</h1>
                        </div>
                    </div>
                </div>
                @include('components.navbar')
            </div>
        </div>
        <div class="navbar navbar-expand row bd-navbar white shadow mr-0">
            <div class="col-12">
                <div class="row mx-auto">
                    <div class="col-2 p-0">
                        <p class=" @if(env('DARKTHEME')==false) text-black @endif">MRN: {{$patients->mrn}}</p>
                    </div>
                    <div class="col-2 p-0">
                        <p class=" @if(env('DARKTHEME')==false) text-black @endif">Gender: {{ucfirst($patients->gender)}}</p>
                    </div>
                    <div class="col-2 p-0">
                        <p class=" @if(env('DARKTHEME')==false) text-black @endif">Age: @php $date = new \DateTime($patients->date_of_birth); $today = \Carbon\Carbon::now(); echo $today->diff($date)->y; @endphp</p>
                    </div>
                </div>
                <div class="row mx-auto">
                    <div class="col-2 p-0">
                        <p class=" @if(env('DARKTHEME')==false) text-black @endif">DOB: {{$patients->date_of_birth}}</p>
                    </div>
                    <div class="col-2 p-0">
                        <p class=" @if(env('DARKTHEME')==false) text-black @endif">Allergies: @if(!empty($patients->allergies)) {{$patients->allergies}} @else No Allergies @endif</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid relative animatedParent animateOnce my-3">
            <div class="row my-3">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card ">

                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><i class="icon icon-mobile text-primary"></i><strong class="s-12">Phone</strong></br> <span class="s-12">{{$patients->phone}}</span></li>
                                    <li class="list-group-item"><i class="icon icon-mail text-success"></i><strong class="s-12">Email</strong></br> <span class="s-12">{{$patients->email}}</span></li>
                                    <li class="list-group-item"><i class="icon icon-address-card-o text-warning"></i><strong class="s-12">Address</strong></br> <span class="s-12">{{$patients->address}}</span></li>
                                </ul>
                            </div>
                            <div class="card mt-3 mb-3">
                                <div class="card-header @if(env('DARKTHEME')==false) bg-white @endif">
                                    <strong class="card-title">Appointments</strong>
                                </div>
                                <div>
                                    <ul class="list-group list-group-flush">
                                        @if($appointments->count() > 0)
                                            @foreach($appointments as $appt)
                                            <li class="list-group-item">
                                                <h6 class="p-t-10">{{$appt->date}}</h6>
                                                <span>{{$appointments->getStaffName($appt->created_by)}} | Room {{$appt->room}} | {{$appt->department_id}}</span>
                                            </li>
                                            @endforeach
                                        @else
                                            <li class="list-group-item">
                                                <h6 class="p-t-10">No Appointments</h6>
                                                <span>NULL | Room NULL | NULL</span>
                                            </li>
                                        @endif
                                    </ul>
                                </div>

                            </div>

                        </div>
                        <div class="col-md-9">
                            <div class="row user-actions">
                                <div class="col-lg-2">
                                    <a href="#" class="btn btn-primary" style="width:100%">Prescriptions</a>
                                </div>
                                <div class="col-lg-2">
                                    <a href="#" class="btn btn-primary" style="width:100%">Labs</a>
                                </div>
                                <div class="col-lg-2">
                                    <a href="#" class="btn btn-primary" style="width:100%">Radiology</a>
                                </div>
                                <div class="col-lg-2">
                                    <a href="#" class="btn btn-primary" style="width:100%">Orders</a>
                                </div>
                            </div>
                            <div class="row my-3">
                            </div>

                            <div class="row my-3">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header @if(env('DARKTHEME')==false) bg-white @endif">
                                            <h6>Patient Notes</h6>
                                            <a href="{{route('notes.create')}}?id={{$patients->id}}" class="btn-fab fab-right-bottom absolute btn-primary text-white shadow1"><i class="icon-add"></i></a>
                                        </div>
                                        <div class="card-body">
                                            <ul class="list-unstyled">
                                                @if($notes->count() > 0)
                                                    @foreach($notes as $note)
                                                    <li class="my-1">
                                                        <div class="card no-b p-3">
                                                            <div class="">
                                                                <div class="float-right">
                                                                    <a href="#" data-id="{{$note->id}}" class="view-note btn-fab btn-fab-sm btn-primary r-5">
                                                                        <i class="icon-eye p-0"></i>
                                                                    </a>
                                                                    <a href="#" class="btn-fab btn-fab-sm btn-success r-5">
                                                                        <i class="icon-pencil p-0"></i>
                                                                    </a>
                                                                </div>
                                                                <div>
                                                                    <div>
                                                                        <strong>Patient Notes for {{$note->date}}</strong>
                                                                    </div>
                                                                    <small>Last Edit: {{\App\PatientNotes::getStaffName($note->created_by)}}</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    @endforeach
                                                @else
                                                    <li class="my-1">
                                                        <div class="card no-b p-3">
                                                            <div class="">
                                                                <div class="float-right">
                                                                    <a href="#" class="btn-fab btn-fab-sm btn-primary r-5">
                                                                        <i class="icon-eye p-0"></i>
                                                                    </a>
                                                                    <a href="#" class="btn-fab btn-fab-sm btn-success r-5">
                                                                        <i class="icon-pencil p-0"></i>
                                                                    </a>
                                                                </div>
                                                                <div>
                                                                    <div>
                                                                        <strong>Seems that this patient has no notes yet!</strong>
                                                                    </div>
                                                                    <small>NULL | NULL</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="notesModal" tabindex="-1" role="dialog" aria-labelledby="roleInfoModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="roleInfoModalLabel">Note</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="notes-modal-content">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.view-note').click(function(e) {
                e.preventDefault();

                let id = $(this).data('id');

                $.ajax
                ({
                    url: '/pnget/'+id,
                    type: 'GET',
                    dataType: 'json',
                    beforeSend: function(){
                        // Show image container
                        $("#loader").show();
                    },
                    complete:function(data){
                        // Hide image container
                        $("#loader").hide();
                    }
                }).done(function (data) {
                    $('#notesModal').modal('show')
                    $('#notes-modal-content').html('');
                    $('#notes-modal-content').html(data.note);
                    console.log(data);
                });
            });
        });
    </script>
@endsection