@extends('tutor.master')

@section('content')
    <div class="page-content">

        @include('tutor.section.breadcrumb', ['title'=> 'SubCategory', 'sub_title'=> 'Insert-SubCategory']);


        <div class="card col-md-8">

            <div class="card-body">

                <div class="card-body p-4">

                    <div style="display: flex; align-items:center; justify-content:space-between">
                        <h5 class="mb-4">Add SubCategory</h5>
                        <a href="{{ route('tutor.subcategory.index') }}" class="btn btn-primary">Back</a>

                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    <!-- <form class="row g-3" method="post" action="{{ route('tutor.subcategory.store') }}">
                        @csrf
                        <div class="col-md-6">
                            <label for="single-select-field" class="form-label">Choose Category</label>
                            <select class="form-select" required name="category_id" id="single-select-field"
                                data-placeholder="Choose one thing">
                                <option selected disabled>Select Category</option>
                                @foreach ($all_categories as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach

                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="name" class="form-label">Subcategory Name</label>
                            <input type="text" class="form-control" name="name" id="name"
                                placeholder="Enter the category name">
                        </div>


                        <div class="col-md-6">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" class="form-control" name="slug" id="slug"
                                placeholder="Enter the slug">
                        </div>

                        <div class="col-md-12">
                            <div class="d-md-flex d-grid align-items-center gap-3">
                                <button type="submit" class="btn btn-primary px-4 w-100">Submit</button>
                            </div>
                        </div>
                    </form> -->
                </div>

            </div>

        </div>





    </div>
@endsection

@push('scripts')
    <script src="{{ asset('customjs/admin/category.js') }}"></script>
@endpush


