@extends('layout.layout')

@section('content')
  @if (Session::has('message'))
    <div class="card-panel red">
      <span class="white-text">{{ Session::get('message') }}</span>
    </div>
  @endif
  
  <table class="bordered highlight centered responsive-table">
    <thead>
      <tr>
        <th>#</th>
        <th>Título</th>
        <th>Criada em</th>
        <th>Ação</th>
      </tr>
    </thead>
    <tbody>
      @foreach($spreadsheets as $spreadsheet)
        <tr>
          <th>{{$spreadsheet->id}}</th>
          <td>
            <a href="{{ route('spreadsheets.show', [$spreadsheet->id]) }}">
              {{$spreadsheet->title}}
            </a>
          </td>
          <td>
            {{ $spreadsheet->created_at ? $spreadsheet->created_at->toFormattedDateString() : ''}}
          </td>
          <td>
            <div class="btn-group">
              <a class="btn waves-effect waves-light" 
                  href="{{ route('spreadsheets.edit', [$spreadsheet->id]) }}">
                Editar
              </a>&nbsp;
              <form action="{{ route('spreadsheets.destroy', [$spreadsheet->id]) }}" method="POST">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn waves-effect waves-light">Deletar</button>
              </form>
            </div>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection