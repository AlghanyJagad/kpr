@extends('layouts.app', ['title' => 'KPR | Kalkulator'])
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Kalkulator KPR</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <tr>
                                  <th class="thead bg-warning" >No</th>
                                  <th class="thead bg-warning" >Angsuran Bunga</th>
                                  <th class="thead bg-warning" >Angsuran Pokok</th>
                                  <th class="thead bg-warning" >Sisa Pinjaman Pokok</th>
                                </tr>
                                @foreach ($object as $item)
                                  <tr>
                                    <td></td>
                                    <td>{{$object->bunga}}</td>
                                    <td>{{$object->pokok}}</td>
                                    <td>{{$object->pinjaman}}</td>
                                  </tr>
                                @endforeach
                                    {{-- 
                                    @foreach ($all['bunga'] as $data)
                                        <td>{{ $data }}</td>
                                    @endforeach
                                    
                                    @foreach ($all['pokok'] as $data)
                                        <td>{{ $data }}</td>
                                    @endforeach
                                    
                                    @foreach ($all['pinjaman'] as $data)
                                        <td>{{ $data }}</td>
                                    @endforeach --}}
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>
@endsection