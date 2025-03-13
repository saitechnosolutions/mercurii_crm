@extends('layouts.app')
@section('title', 'Terms and Conditions Details')
@section('main-content')

    {{-- @include('sweetalert::alert') --}}

    <section class="section leadsection container" >
        <div class=" form-card">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6">
                            <h5 class="mt-2">Terms Details</h5>
                        </div>
                        <div class="col-lg-4">

                        </div>
                        <div class="col-lg-2">
                            <a href="/addterms" class="btn btn-primary d-block add-employee-btn" >Add Terms Content</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <div class="container mt-5">
        <div class="card">
            <div class="card-header">All Contents</div>
            <div class="card-body">
                <table id="terms-table" class="display">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Invoice</th>
                            <th>Terms Type</th>
                            <th>Content</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($terms as $index => $term)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    @if ($term->whichterm == 1)
                                    Sales Quotation
                                    @elseif ($term->whichterm == 2)
                                    PO Invoice
                                    @else
                                        Unknown
                                    @endif
                                </td>
                                <td>
                                    @if ($term->termtype == 1)
                                        Terms and Conditions
                                    @elseif ($term->termtype == 2)
                                        Warranty Terms
                                    @else
                                        Unknown
                                    @endif
                                </td>
                                <td>{{ $term->content }}</td>
                                <td>
                                    <div class="vendor-action d-flex">
                                        <a href="{{ route('terms.edit', $term->id) }}" class="btn btn-info me-2"><i class="fas fa-edit"></i>
                                        </a>
                                        <form method="POST" action="{{ url('/terms/delete/' . $term->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this term?')"><i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                        @if ($term->term_approve == 1)
                                        <button type="button" class="btn btn-success ms-2" data-bs-toggle="modal" data-bs-target="#approveModal">
                                            <i class="fas fa-check-circle"></i>
                                        </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No terms found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>


    <div class="modal fade" id="approveModal" tabindex="-1" aria-labelledby="approveModalLabel{{ $term->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('terms.approve', $term->id) }}">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="approveModalLabel{{ $term->id }}">Approve Term</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <p>Do you want to approve this term?</p>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="term_approve" value="0" id="approveYes{{ $term->id }}" {{ $term->term_approve == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="approveYes{{ $term->id }}">Yes</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="term_approve" value="1" id="approveNo{{ $term->id }}" {{ $term->term_approve == 0 ? 'checked' : '' }}>
                            <label class="form-check-label" for="approveNo{{ $term->id }}">No</label>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section("scripts")
<script>
    let table = new DataTable('#terms-table');
</script>
@endsection
