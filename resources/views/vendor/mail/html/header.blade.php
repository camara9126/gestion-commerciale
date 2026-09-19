@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{asset('asset/logo/Logo B.Manager.png')}}" width="100" class="logo" alt="Logo Bmanager">
@else
{!! $slot !!}
@endif
</a>
</td>
</tr>
