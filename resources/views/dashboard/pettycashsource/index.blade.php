@extends('layout.app')

@section('content')
 
<div class="content">
    <div class="container-fluid">
        <button class="btn bg-gradient-dark btn-sm" data-bs-toggle="modal" data-bs-target="#addModal">
                                <i class="bi bi-plus"></i> Add
                            </button>
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header ">
                    
                        <h4 class="mb-0">Petty Cash Sources</h4>
                    </div>

                    <div class="card-body">

                        

                        @include('dashboard.pettycashsource.add')

                        <table class="table table-flush" id="datatable-search">
                            <thead class="thead-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($pettycashsources as $pettycashsource)
                                <tr>
                                    <td>{{ $pettycashsource->name }}</td>
                                    <td>{{ $pettycashsource->description }}</td>
                                    <td class="text-end">

                                        {{-- Edit Button --}}
                                        <button class="text-secondary" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#editModal{{ $pettycashsource->id }}">
                                            <i class="fa fa-edit"></i>
                                        </button>

                                        {{-- Delete --}}
                                        <button class="text-secondary" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#deleteModal{{ $pettycashsource->id }}">
                                            <i class="fa fa-trash"></i>
                                        </button>


                                        {{-- Hidden Delete Form --}}
                                        <form id="delete-form-{{ $pettycashsource->id }}" 
                                              action="{{ route('pettycashsource.destroy', $pettycashsource->id) }}" 
                                              method="POST"
                                              style="display:none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>

                                        {{-- Delete Modal --}}
                                        <div class="modal fade" id="deleteModal{{ $pettycashsource->id }}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Confirm Delete</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        Are you sure you want to delete this Petty Cash Source?
                                                        <br>
                                                        <strong>This action cannot be undone.</strong>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="button" class="btn btn-danger"
                                                                onclick="document.getElementById('delete-form-{{ $pettycashsource->id }}').submit();">
                                                            <i class="fa fa-trash"></i> Confirm
                                                        </button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>

                                {{-- Edit Modal --}}
                                <div class="modal fade" id="editModal{{ $pettycashsource->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <form action="{{ route('pettycashsource.update', $pettycashsource->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')

                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Petty Cash Source</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="modal-body">

                                                    <div class="mb-3">
                                                        <label>Name</label>
                                                        <input type="text" class="form-control" name="name"
                                                               value="{{ $pettycashsource->name }}" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label>Description</label>
                                                        <textarea class="form-control" name="description">{{ $pettycashsource->description }}</textarea>
                                                    </div>

                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
