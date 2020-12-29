@extends('layouts.admin')
@section('judul','Midtrans')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Midtrans</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Midtrans</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
      @if($msg = session('success'))
      <div class="alert alert-success" role="alert">
         {{ $msg }}
        </div>
        @elseif($msg = session('error'))
        <div class="alert alert-danger" role="alert">
            {{ $msg }}
        </div>
      @endif

      <div class="row">

        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                <form action="{{ route('midtrans.store') }}" method="post">
            @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">URL API </label>
                    <input type="hidden" name="id" value="{{$config->id}}">
                    <input type="text" class="form-control" id="exampleInputEmail1" name="url" value="{{ $config->url }}" aria-describedby="emailHelp" placeholder="Masukan Client Key">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Client Key</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" value="{{ $config->client_key }}" name="client_key" aria-describedby="emailHelp" placeholder="Masukan Client Key">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Secret Key</label>
                    <input type="text" class="form-control"  name="secret_key" value="{{ $config->secret_key }}" id="exampleInputPassword1" placeholder="Masukan Secret Key">
                </div>
                <button type="submit" id="submits" class="btn btn-primary">Simpan</button>
            
                </div>
                </form>

            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                <h5>Production</h5>
                    <small>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repellendus soluta quasi odit sed rem neque quae exercitationem fugiat fugit, mollitia consequatur similique quidem atque optio voluptate voluptatem illo. Unde, ut!</small>
                    <hr>
                    <div class="form-group">
                    <!-- <label for="">Hidupkan production</label> -->
                        <input type="checkbox" id="checkbox" @if($config->production === 1) checked @endif name="checkbox1" data-toggle="toggle" data-width="100">
                    </div>
                </div>
            </div>
        </div>

        
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                <form action="{{ route('api.spp.update') }}" method="post">
            @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Tagihan SPP</label>
                    <input type="hidden" name="id" value="{{$config->id}}">
                    <input type="number" class="form-control" id="exampleInputEmail1" name="spp_bulanan" value="{{ $config->spp_bulanan }}" aria-describedby="emailHelp">
                </div>
                <button type="submit" id="submits" class="btn btn-primary">Simpan</button>
            
                </div>
                </form>

            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                <h5>SPP Bulanan</h5>
                    <small>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repellendus soluta quasi odit sed rem neque quae exercitationem fugiat fugit, mollitia consequatur similique quidem atque optio voluptate voluptatem illo. Unde, ut!</small>
                    <hr>
                    
                </div>
            </div>
        </div>

      </div>

    </div>
</div>
<script>
    $(document).ready( () => {
        var checkbox = $("input[name='checkbox1']")
        
        $(checkbox).on('change', () => {
            if($(checkbox).is(":checked"))
            {
                $.ajax({
                    url: "{{ route('midtrans.turn.on') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: (data) => {
                        if(data == true)
                        {
                            alert('Production is running')
                        }
                    }
                })
            }else{
                $.ajax({
                    url: "{{ route('midtrans.turn.off') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: (data) => {
                        if(data == true)
                        {
                            alert('Production is disabled') 
                        }
                    }
                })
            }
        })
    })
</script>
@endsection