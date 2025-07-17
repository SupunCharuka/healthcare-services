@extends('backend.customer.layouts.master')

@section('title', 'Support Ticket')
@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/bootstrap.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/dataTables.bootstrap4.min.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/css/datatables/customize-datatables.css') }}">
@endsection

@section('content')
    <div class="content-container">
        <div class="outer-container">


            <div class="doctors-appointment">
                <div class="title-box inquiry">
                    <h3>View & Reply Tickets</h3>
                </div>
                <div class="card-body">
                    @if (session('status'))
                       <div class="alert alert-success" role="alert">
                          {{ session('status') }}
                       </div>
                    @endif
                    <div class="mb-2">
                       <table class="table table-bordered table-striped">
                          <tbody>
                             <tr>
                                <th>
                                   ID
                                </th>
                                <td>
                                   {{ $ticket->id }}
                                </td>
                             </tr>
                             <tr>
                                <th>
                                   Created at
                                </th>
                                <td>
                                   {{ $ticket->created_at }}
                                </td>
                             </tr>
                             <tr>
                                <th>
                                    Title
                                </th>
                                <td>
                                   {{ $ticket->title }}
                                </td>
                             </tr>
                             <tr>
                                <th>
                                   Description
                                </th>
                                <td>
                                   {{ $ticket->description}}
                                </td>
                             </tr>
                             <tr>
                                <th>
                                   Attachments
                                </th>
                                <td>
                                   @if (!empty($ticket->file))
                                      <img src="https://img.icons8.com/fluency/48/000000/pdf-mail.png" />
                                      <a href="{{ storage('uploads/service-provider/ticket/' . $ticket->file) }}" target="blank">
                                         View File
                                      </a>
                                   @endif
                                </td>
                             </tr>
                             <tr>
                                <th>
                                   Replies
                                </th>
                                <td>
                                   <livewire:customer.ticket.reply :ticket="$ticket" />
                                </td>
                             </tr>
                          </tbody>
                       </table>
                    </div>
                    <a class="bg-warning btn my-2" href="{{ route('customer.supportTicket') }}"> Back to list </a>
                    <a href="{{  route('customer.supportTicket.edit', ['ticket' => $ticket->id]) }}" class="btn btn-primary">
                       Edit Ticket
                    </a>
                    <nav class="mb-3">
                       <div class="nav nav-tabs">
                       </div>
                    </nav>
                 </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/backend/js/datatable/datatables/jquery.dataTables.1.10.24.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/datatable/datatables/dataTables.bootstrap4.min.js') }}"></script>
@endsection
