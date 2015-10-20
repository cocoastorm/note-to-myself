<!-- resources/views/welcome.blade.php -->
<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

    </head>
    <body>
      <table>
        <tr>
          <td>Email</td>
          <td>Notes</td>
          <td>Websites</td>
          <td>TBD</td>
        </tr>
        @foreach($notes as $n)
        <tr>
          <td>{{$n->email}}</td>
          <td>{{$n->notes}}</td>
          <td>{{$n->websites}}</td>
          <td>{{$n->tbd}}</td>
        </tr>
        @endforeach
      </table>


{!!Form::open([
  'route'=>'notes.store'
])!!}
<div class="form-group">
    {!! Form::label('Email') !!}
    {!! Form::text('email', null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('Notes: ') !!}
    {!! Form::textarea('notes', null,
        array('required',
              'class'=>'form-control',
              'placeholder'=>'Your message')) !!}
</div>
<div class="form-group">
    {!! Form::label('websites') !!}
    {!! Form::text('websites', null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('TBD') !!}
    {!! Form::text('tbd', null,['class'=>'form-control']) !!}
</div>



{!! Form::submit('Save', ['class'=>'btn btn-primary'])!!}
{!! Form::close() !!}

    </body>
</html>
