@extends('layouts.app')

@section('content')

    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
{{--    <script--}}
{{--        type="text/javascript"--}}
{{--        src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"--}}
{{--    ></script>--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>--}}

    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="uper">
        @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div><br />
        @endif
        <table class="table table-striped">
            <thead>
            <tr>
                <td>id </td>
                <td>title</td>
                <td>parent_id</td>
                <td></td>


                <td colspan="3">Action</td>
            </tr>
            </thead>
            <tbody>





            @foreach($categories as $category)
                <tr>
                    <td>{{$category->id }}</td>
                    <td>{{$category->title  }}</td>
                    <td>{{$category->parent_id }}</td>


                    <td>
                       <form action="/addSubcategory/{{ $category->id }}" method="post">
                           @csrf
                           <button type="submit" class="btn btn-success"  > add sub category </button>
                           <input class="form-control" id="subcategorty" name="new_subcategory">
                       </form>
                    </td>

                    <td>
                        <form action="/categories/{{ $category->id }}"
                              method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>





                </tr>
            @endforeach



            </tbody>
        </table>
    </div>








    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="card uper">
        <div class="card-header">
            Add category
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br />
            @endif
            <form method="post"
                  action="/categories/{{ $category->id }}"
                  enctype="multipart/form-data">

                <div class="form-group">
                    <label for="title"> Title</label>
                    <input type="text" class="form-control"
                           name="title"/>
                </div>


                <div class="form-group" id="parent_id">
                    @csrf
                    <label for="parent_id"> belong to category</label>
                    <select class="form-control"
                          name="parent_id" >

                        @foreach($categories as $c)
                            <option value="{{$c->id}}">
                                {{$c->title}}  </option>
                        @endforeach

                    </select>
                </div>

{{-- <input type="hidden" name="parent_id" id="parent_id" value=""/>--}}

                <button type="submit"
                        class="btn btn-primary">Add</button>
            </form>
{{--     put belong to button outside the form to fix the problem of submit or refresh the page when click the button --}}
                <div class="form-group">
                    <button onclick="belongsTo()"> belongs to category</button>
                </div>

        </div>
    </div>
@endsection
<style>
#parent_id{
    display:none;
}
</style>


<script>
    // document.getElementById("parent_id").display="none";

    function belongsTo() {
        var x = document.getElementById("parent_id");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }

    // document.getElementById("subcategorty").display="none";
    // function show_input_to_add_subategory(){
    //     var x = document.getElementById("subcategorty");
    //     if (x.style.display === "none") {
    //         x.style.display = "block";
    //     } else {
    //         x.style.display = "none";
    //     }
    //
    // }




    // $('input[name=sub]').change(function() {
    //     if ($(this).is(':checked')  ) {
    //         console.log(document.getElementById('selected_option').value);
    //     }
    //     else { document.getElementById('parent_id').value=null;}
    //
    // });

</script>
