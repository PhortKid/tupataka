{{-- 
@extends('layout.app')
@section('content')

--}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>




<div class="col-md-12">
    
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Vehicle Management </h4>
              </div>
              <div class="card-content">
                <div class="row">
                  <div class="col-md-2">
                    <ul class="nav nav-pills nav-pills-success nav-stacked">
                      <li class="active"><a href="#tab1" data-bs-toggle="tab">Vehicle</a></li>
                      <li><a href="/vehicle_service_category">Service Category</a></li>
         
                    </ul>
                  </div>
                  <div class="col-md-10">
                    <div class="tab-content">
                      <div class="tab-pane active" id="tab1">
                        

                      
                    

    <button class="btn btn-success mb-2" data-bs-toggle="modal" data-bs-target="#addVehicleModal">Add Vehicle</button>
     <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
        <thead>
            <tr>
                <th>Plate Number</th>
                <th>Type</th>
                <th>Capacity</th>
                <th>Availability</th>
              
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vehicles as $vehicle)
            <tr>
                <td>{{ $vehicle->plate_number }}</td>
                <td>{{ $vehicle->type }}</td>
                <td>{{ $vehicle->capacity }}</td>
             
                <td>{{ $vehicle->status == '1' ? 'Active' : 'Inactive' }}</td>
                <td>
                    <!-- Edit Vehicle Icon Link -->
                    <a href="#" class="text-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editVehicleModal{{ $vehicle->id }}" title="Edit">
                    <i class="fas fa-edit"></i>
                    </a>

                    <!-- Delete Vehicle Icon Link -->
                    <a href="#" class="text-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteVehicleModal{{ $vehicle->id }}" title="Delete">
                    <i class="fas fa-trash-alt"></i>
                    </a>

                </td>
            </tr>

            <!-- Edit Modal -->
            <div class="modal fade" id="editVehicleModal{{ $vehicle->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <form method="POST" action="{{ route('test.demo', $vehicle->id) }}">
                        @csrf
                        
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Vehicle</h5>
                                <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <input type="text" name="plate_number{{ $vehicle->id }}" name="plate_number"  class="form-control mb-2" value="{{ $vehicle->plate_number }}" required placeholder="Plate Number">
                                <input type="text" name="type" class="form-control mb-2" value="{{ $vehicle->type }}" required placeholder="Type">
                                <input type="text" name="capacity" class="form-control mb-2" value="{{ $vehicle->capacity }}" required placeholder="Capacity">
                                <input type="text" name="availability_status" class="form-control mb-2" value="{{ $vehicle->availability_status }}" required placeholder="Availability">
                                
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-ssuccess">Save Changes</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Delete Modal -->
            <div class="modal fade" id="deleteVehicleModal{{ $vehicle->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <form method="POST" action="{{ route('vehicle.destroy', $vehicle->id) }}">
                        @csrf
                        @method('DELETE')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Delete Vehicle</h5>
                                <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete this vehicle?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-danger">Delete</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            @endforeach
        </tbody>
    </table>
</div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addVehicleModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('vehicle.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Vehicle</h5>
                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="text" name="plate_number" class="form-control mb-2" required placeholder="Plate Number">
                    <input type="text" name="type" class="form-control mb-2" required placeholder="Type">
                    <input type="text" name="capacity" class="form-control mb-2" required placeholder="Capacity">
                    <input type="text" name="availability_status" class="form-control mb-2" required placeholder="Availability">
                    
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Add</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>

                      </div>
                      <div class="tab-pane" id="tab2">
                       
                      </div>
                      <div class="tab-pane" id="tab3">
                       
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>





</body>
</html>



  

{{-- 
@endsection 
--}}