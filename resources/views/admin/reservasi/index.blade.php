@extends('layouts.master_admin')
@section('content')

  
<div class="main-content">
    <section class="section">
        <div class="card mt-5">
            <div class="d-flex justify-content-center mt-5">
                <h4>Reservasi</h4>
            </div>
           
            <div class="card-body">


                <table class="table table-bordered reservasi-ajax">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Tamu</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

@endsection
@push('scripts')
<script type="text/javascript">
    $(function() {

        var table = $('.reservasi-ajax').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('reservasi.ajax') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'nama_pemesan',
                    name: 'nama_pemesan'
                },
                {
                    data: 'check_in',
                    name: 'check_in'
                },
                {
                    data: 'check_out',
                    name: 'check_out'
                },
                {
                    data: 'status',
                    name: 'status'
                }
                 
              
            ]
        });

    });
</script>
@endpush

