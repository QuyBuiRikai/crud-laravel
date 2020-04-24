@extends('products.layout')
 
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Laravel 6 CRUD </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('products.create') }}"> Create New Product</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <form action="/search" method="get">
        <div class="form-group form-inline">
            <label for="name">Name</label>
            <input type="search" name="name" id="name" class="form-control" >
            <label for="detail">Detail</label>
            <input type="search" name="detail" id="detail" class="form-control">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>
      

<form method="post">
    @csrf
    @method('DELETE')
    <button formaction="/deleteall" type="submit" class="btn btn-danger"> Delete All Selected </button>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th><input type="checkbox" class="selectall"></th>
                <th>Name</th>
                <th>Details</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td><input type="checkbox" name="ids[]" class="selectbox" value="{{ ++$i }}"></td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->detail }}</td>
                <td>
                   
                    <a class="btn btn-info" href="{{ route('products.show',$product->id) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}">Edit</a>
    
                    <button formaction="{{ route('products.destroy',$product->id) }}" type="submit" class="btn btn-danger">Delete</button>
                
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</form>
    {{ $products->withQueryString()->links() }}

    <script type="text/javascript">
        $('.selectall').click(function(){
            $('.selectbox').prop('checked', $(this).prop('checked'));
            $('.selectall2').prop('checked', $(this).prop('checked'));
        })
        // $('.selectall2').click(function(){
        //     $('.selectbox').prop('checked', $(this).prop('checked'));
        //     $('.selectall').prop('checked', $(this).prop('checked'));
        // })
        $('.selectbox').change(function(){
            var total = $('.selectbox').length;
            var number = $('.selectbox:checked').length;
            if(total == number){
                $('.selectall').prop('checked', true);
                // $('.selectall2').prop('checked', true);
            } else {
                $('.selectall').prop('checked', false);
                // $('.selectall2').prop('checked', false);
            }
        })
    </script>
      
@endsection