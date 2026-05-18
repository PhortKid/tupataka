@extends('layout.app')
@section('content')

<div class="container-fluid">
    <div class="card shadow-sm mt-3">

        <!-- HEADER -->
        <div class="card-header  ">
            <h4 class="card-title mb-0">Vehicle Management</h4>
        </div>

        <div class="card-body">

            <div class="row">

                <!-- LEFT SIDE MENU -->
                <div class="col-md-2 mb-3">
                    <ul class="nav flex-column nav-pills">
                        <li class="nav-item">
                            <a class="nav-link" href="/vehicle">Vehicle</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="pill" href="#tabCategory">
                                Service Category
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- RIGHT SIDE CONTENT -->
                <div class="col-md-10">
                    <div class="tab-content">

                        <!-- SERVICE CATEGORY TAB -->
                        <div class="tab-pane fade show active" id="tabCategory">

                            <button class="btn bg-gradient-dark mb-3" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                                <i class="fas fa-plus"></i> Add Category
                            </button>

                            <div class="table-responsive">
                                <table class="table table-flush" id="datatable-search">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Service Name</th>
                                            <th>Description</th>
                                            <th width="120">Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($categories as $category)
                                        <tr>
                                            <td>{{ $category->service_name }}</td>
                                            <td>{{ $category->description }}</td>

                                            <td>
                                                <!-- EDIT -->
                                                <a href="#" class=" me-3"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editCategoryModal{{ $category->id }}">
                                                    <i class="fas fa-edit text-secondary"></i>
                                                </a>

                                                <!-- DELETE -->
                                                <a href="#" class="text-danger"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteCategoryModal{{ $category->id }}">
                                                    <i class="fas fa-trash-alt text-secondary"></i>
                                                </a>
                                            </td>
                                        </tr>

                                        <!-- EDIT CATEGORY MODAL -->
                                        <div class="modal fade" id="editCategoryModal{{ $category->id }}">
                                            <div class="modal-dialog">
                                                <form method="POST" action="{{ route('vehicle_service_category.update', $category->id) }}">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Category</h5>
                                                            <button class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>

                                                        <div class="modal-body">

                                                            <div class="mb-3">
                                                                <label class="form-label">Service Name</label>
                                                                <input type="text" name="service_name" class="form-control"
                                                                    value="{{ $category->service_name }}" required>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label">Description</label>
                                                                <input type="text" name="description" class="form-control"
                                                                    value="{{ $category->description }}">
                                                            </div>

                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn bg-gradient-dark">Save Changes</button>
                                                            <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        </div>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>

                                        <!-- DELETE CATEGORY MODAL -->
                                        <div class="modal fade" id="deleteCategoryModal{{ $category->id }}">
                                            <div class="modal-dialog">
                                                <form method="POST" action="{{ route('vehicle_service_category.destroy', $category->id) }}">
                                                    @csrf
                                                    @method('DELETE')

                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Delete Category</h5>
                                                            <button class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>

                                                        <div class="modal-body">
                                                            Are you sure you want to delete this category?
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                            <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        </div>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>

                                        @endforeach
                                    </tbody>

                                </table>
                            </div>

                        </div> <!-- END TAB -->

                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

<!-- ADD CATEGORY MODAL -->
<div class="modal fade" id="addCategoryModal">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('vehicle_service_category.store') }}">
            @csrf

            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Add Category</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Service Name</label>
                        <input type="text" name="service_name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <input type="text" name="description" class="form-control">
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Add</button>
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>

            </div>

        </form>
    </div>
</div>

@endsection
