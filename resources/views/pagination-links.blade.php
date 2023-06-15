@if ($paginator->hasPages())

@for ($i = 1; $i <= $paginator->lastPage(); ++$i)
<a href=" {{url()->full()}}&page={{$i}}" class=" py-2 px-3 rounded-circle text-decoration-none {{Request::get('page')==$i || !Request::has('page') && $i==1 ?'bg-main text-light':'bg-light text-dark'}}">{{$i}}</a>

@endfor
@endif
      
      