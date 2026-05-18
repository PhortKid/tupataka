@extends('layout.app')

@section('content')

<div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-icon" data-background-color="green">
                <i class="material-icons">attach_money</i>
              </div>
              <div class="card-content">
              
                <div class="text-right">
                    <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#disablebackdrop">
                        <i class="bi bi-plus"></i> Add 
                    </a>
                </div>
                    
                @include('dashboard.pettycash_received.add')

                <div class="toolbar">
                  <!-- Extra toolbar buttons if needed -->
                </div>

                <div class="material-datatables">
                  <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                    <thead>
                      <tr>
                        <th>Date</th>
                        <th>Source</th>
                        <th>Amount</th>
                        <th>Description</th>
                        <th class="disabled-sorting text-right">Actions</th>
                      </tr>
                    </thead>
                  
                    <tbody>
                    @foreach($pettyCashReceived as $petty)
                    <tr>
                      <td>{{ $petty->date_received }}</td>
                      <td>{{ $petty->source->name ?? 'N/A' }}</td>
                      <td>{{ number_format($petty->amount, 2) }}</td>
                      <td>{{ $petty->description }}</td>
                      <td class="text-right">
                        
                        <!-- Edit Button -->
                        <a href="#" class="btn btn-simple btn-warning btn-icon" data-toggle="modal" data-target="#editPetty{{ $petty->id }}">
                          <i class="fa fa-edit"></i>
                        </a>
                        
                        <!-- Delete Button -->
                        <a href="#" class="btn btn-simple btn-icon btn-danger" data-toggle="modal" data-target="#deleteModal{{ $petty->id }}">
                          <i class="fa fa-trash"></i>
                        </a>

                        <form id="delete-form-{{ $petty->id }}" action="{{ route('pettycash_received.destroy', $petty->id) }}" method="POST" style="display:none;">
                            @csrf
                            @method('DELETE')
                        </form>

                        <!-- Delete Confirmation Modal -->
                        <div class="modal fade" id="deleteModal{{ $petty->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $petty->id }}" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">Confirm Delete</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                Are you sure you want to delete this Petty Cash record? This action cannot be undone!
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-danger" onclick="document.getElementById('delete-form-{{ $petty->id }}').submit();">
                                  <i class="fa fa-trash"></i> Confirm
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editPetty{{ $petty->id }}" tabindex="-1" role="dialog">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <form action="{{ route('pettycash_received.update', $petty->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Edit Petty Cash Received</h4>
                            </div>
                            <div class="modal-body">
                              <div class="form-group">
                                <label>Date</label>
                                <input type="date" class="form-control" name="date_received" value="{{ $petty->date_received }}" required>
                              </div>
                              <div class="form-group">
                                <label>Source</label>
                                <select class="form-control" name="cash_source_id" required>
                                  @foreach($sources as $source)
                                    <option value="{{ $source->id }}" {{ $petty->cash_source_id == $source->id ? 'selected' : '' }}>
                                      {{ $source->name }}
                                    </option>
                                  @endforeach
                                </select>
                              </div>
                              <div class="form-group">
                                <label>Amount</label>
                                <input type="number" step="0.01" class="form-control" name="amount" value="{{ $petty->amount }}" required>
                              </div>
                              <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="description">{{ $petty->description }}</textarea>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-success">Update</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>

                    @endforeach
                    </tbody>
                  </table>
                </div>
              </div><!-- end content-->
            </div><!--  end card  -->
          </div> <!-- end col-md-12 -->
        </div> <!-- end row -->
@endsection
