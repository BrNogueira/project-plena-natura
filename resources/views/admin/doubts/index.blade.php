
@extends('admin.layouts.app')

@section("content")
<div class="col-md-10">
         <form method="POST" onsubmit="return confirm('Deseja mesmo excluir?');" action="/admin/ajuda/duvidas/delete">
    <table class="table table-hover novo_table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">ID</th>
                <th scope="col">Dúvida</th>
              </tr>
            </thead>
            <tbody>
              @php
               $i = 1;
              @endphp
              @foreach($doubts as $doubt)
                  <tr>
                    <th> <input type="checkbox" name="doubts[]" value="{{$doubt->id}}"></th>
                    <td scope="row">{{$i}}</td>
                    <td><a href="/admin/ajuda/duvidas/editar/{{$doubt->id}}">{{$doubt->question}}</a></td>
                  </tr>
                  @php
                   $i++;
                  @endphp
              @endforeach
            </tbody>
      </table>
      <div class="pull-right">
          {{ $doubts->links() }}
      </div>
</div>
<div class="col-md-2">
   <div class="col-md-2">
      <ul class="nav flex-column">
         <li class="nav-item">
            <a class="nav-link" href="/admin/ajuda/duvidas/novo">Incluir </a>
         </li>
         <li class="nav-item">

            <button type="submit" class="btn btn-link nav-link" name="excluir" value="1">Excluir </button>

         </li>
         <li class="nav-item">
            <a class="nav-link" href="#">Imprimir selecionados</a>
         </li>
         <li class="nav-item">
            <a class="nav-link" href="#">Exportar dados</a>
         </li>
      </ul>
   </div>
</div>
@csrf
    </form>
@endsection
