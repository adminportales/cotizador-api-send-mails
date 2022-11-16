@component('mail::message')
# Estimado: {{ $cliente }}.
Muchas gracias por elegirnos como tu mejor opción para tus productos promocionales, recuerda que la mejor alternativa siempre estará a tu alcance con nosotros, cualquier cambio o ajuste por favor házmelo saber para enviarlo a la brevedad.
<br>
Saludos
# Favor de no responder a este correo, si desea comunicarse con {{ $vendedor }}, favor de enviar un email a {{ $email }}.
@endcomponent
