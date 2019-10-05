@component('mail::message')
<p style="position: relative;margin-bottom: 20px;align-items:center;"><img src="{{ env('APP_URL') . '/storage/logo.png' }}" style="position: relative; left: 42%; width: 15%;" alt=""></p>
# Se han puesto en contacto con nostros !
<table class="action" width="100%" cellpadding="0" cellspacing="0">
<tr>
<td style="font-size: 18px;"><strong>Nombre : </strong></td>
<td style="font-size: 18px;">{{$data['name']}}</td>
</tr>
<tr>
<td style="font-size: 18px;"><strong>Email : </strong></td>
<td style="font-size: 18px;">{{$data['email']}}</td>
</tr>
<tr>
<td style="font-size: 18px;"><strong>Mensaje : </strong></td>
<td style="font-size: 18px;">{{$data['message']}}</td>
</tr>
</table>
@endcomponent
