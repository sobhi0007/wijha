@if ($units->hasPages())

@for ($i = 1; $i <= $paginator->lastPage(); ++$i)
<a href="&page={{$i}}" class="text-light py-2 px-3 rounded-circle text-decoration-none bg-main">{{$i}}</a>
<a href="#" class="text-light py-2 px-3 rounded-circle text-decoration-none bg-light text-dark border">2</a>

@endfor
@endif
      
      