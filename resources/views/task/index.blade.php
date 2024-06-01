@extends('template')
@section('content')
    <div class="container">
      <div class="text-center title">Daftar Tugas</div>
      <hr> 

      <div class="row">
      @foreach ($tasks as $task)
        <div class="col-12 col-md-4">
          <div class="card mt-2">
            <div class="card-body">
              <h4 class="card-title">{{$task['name']}}</h4>
              <small>{{\Carbon\Carbon::parse($task['deadline'])->format('d M Y')    }} </small> <br>
              <span class="badge bg-warning">{{$task['status']}}</span>
              <p class="card-text">{{Str::limit($task['description'], 40, '...') }}</p>

              <div class="mt-2">
                <a href="#" class="btn btn-primary">Detail</a>
                <a href="#" class="btn btn-warning">Edit</a>
                <a href="#" class="btn btn-danger">Hapus</a>
              </div>
            </div>
          </div>
        </div>
      @endforeach
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
