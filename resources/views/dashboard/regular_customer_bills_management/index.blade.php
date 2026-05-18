@extends('layout.app')

@section('content')

<div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-icon" data-background-color="green">
                <i class="material-icons">people</i>
                
              </div>
              <div class="card-content">
              
                  
                        <div class="text-right">
                        <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#disablebackdrop">
                            <i class="bi bi-plus"></i> Add 
                        </a>
                        </div>
                    
                    @include('dashboard.regular_customer_bills_management.add')

                <div class="toolbar">
                  <!--        Here you can write extra buttons/actions for the toolbar              -->
                </div>
                <div class="material-datatables">
                  <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                    <thead>
                    <tr>
                      <th>Name</th>
                      <th>Rate</th>
                      <th class="disabled-sorting text-right">Actions</th>
                    </tr>
                    </thead>
                  
                    <tbody>
                    @foreach($customer_bills as $customer_bill)
                    <tr>
                      <td>{{ $customer_bill->name }}</td>
                      <td>{{ $customer_bill->rate }}</td>
                      <td class="text-right">
                        <a href="#" class="btn btn-simple btn-warning btn-icon" data-toggle="modal" data-target="#editCustomerBill{{$customer_bill->id}}">
                          <i class="fa fa-edit"></i>
                        </a>
                        <!-- Delete button opens modal -->
                        <a href="#" class="btn btn-simple btn-icon btn-danger" data-toggle="modal" data-target="#deleteModal{{ $customer_bill->id }}">
                          <i class="fa fa-trash"></i>
                        </a>
                        <form id="delete-form-{{ $customer_bill->id }}" action="{{ route('regular_customer_bill_management.destroy', $customer_bill->id) }}" method="POST" style="display:none;">
                            @csrf
                            @method('DELETE')
                        </form>
                        <!-- Delete Confirmation Modal -->
                        <div class="modal fade" id="deleteModal{{ $customer_bill->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $customer_bill->id }}" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel{{ $customer_bill->id }}">Confirm Delete</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                Are you sure you want to delete this Bill? This action cannot be undone!
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-danger" onclick="document.getElementById('delete-form-{{ $customer_bill->id }}').submit();">
                                  <i class="fa fa-trash"></i> Confirm
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>


                    <!-- Edit Region Modal -->
<div class="modal fade" id="editCustomerBill{{ $customer_bill->id }}" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="{{ route('regular_customer_bill_management.update', $customer_bill->id) }}" method="POST">
       
        @csrf
        @method('PUT')
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Bill</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="name{{ $customer_bill->id }}">Name</label>
            <input type="text" class="form-control" name="name" value="{{ $customer_bill->name }}" required>
          </div>
          <div class="form-group">
            <label for="description{{ $customer_bill->id }}">Rate</label>
            <input type="text" class="form-control" name="rate" value="{{ $customer_bill->rate }}">
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