
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>

    <title>Document</title>
</head>
<body>
    <div class="form-group">
        <label for=""@error('role_id') class="text-danger" @enderror >Provinsi</label>
        <div class="form-group @error('id_provinsi') has-error @enderror " >
            <select class="form-control" name="id_provinsi" id="id_provinsi">
                <option value="" selected disabled>Select</option>
                @foreach ($provinsi as $r)
                    <option value="{{ $r->id }}">{{ $r->name}}</option>
                @endforeach
            </select>
            @error('role_id')
                <span  class="help-block"> {{ $message }} </span>
            @enderror
        </div>
        <div class="form-group d-none @error('id_kota') has-error @enderror " id="kota">
            <label for="title">Kota</label>
            <select name="id_kota" class="form-control" id="id_kota" >
            </select>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<script>
  $(document).ready(function () {
      $('#id_provinsi').change(function () {
          var $kota = $('#id_kota');
          $.ajax({
              url: "{{ route('kota.index') }}",
              data: {
                  id_provinsi: $(this).val()
              },
              success: function (data) {
                  $kota.html('<option value="" selected>Pilih Kota</option>');
                  $.each(data, function (id, value) {
                      $kota.append('<option value="' + id + '">' + value + '</option>');
                  });
              }
          });
          $('#id_kota, #id_distrik, #id_desa').val("");
          $('#kota').removeClass('d-none');
      });
      $('#id_kota').change(function () {
          var $distrik = $('#id_distrik');
          $.ajax({
              url: "{{ route('distrik.index') }}",
              data: {
                  id_kota: $(this).val()
              },
              success: function (data) {
                  $distrik.html('<option value="" selected>Choose city</option>');
                  $.each(data, function (id, value) {
                      $distrik.append('<option value="' + id + '">' + value + '</option>');
                  });
              }
          });
          $('#id_distrik, #id_desa').val("");
          $('#distrik').removeClass('d-none');
      });
      $('#id_distrik').change(function () {
          var $desa = $('#id_desa');
          $.ajax({
              url: "{{ route('desa.index') }}",
              data: {
                  id_distrik: $(this).val()
              },
              success: function (data) {
                  $desa.html('<option value="" selected>Choose city</option>');
                  $.each(data, function (id, value) {
                      $desa.append('<option value="' + id + '">' + value + '</option>');
                  });
              }
          });
          $('#id_desa').val("");
          $('#desa').removeClass('d-none');
      });
  });
</script>  
</body>
</html>