@extends('layouts.app')

@section('content')
@can('viewAny', \App\Program::class)
<div class="row justify-content-center  ">
  <div class="col-md-8">
    <form class="" method="GET" action="{{route('searchs.index')}}">
      @csrf
    <div class="input-group mb-2">
      <input class="form-control " type="search" placeholder="Student" aria-label="Find Student" name="keyword">
      <button class="input-group-append btn btn-primary  " type="submit"><i class="fa fa-search"></i></button>
    </div>
    </form>
  </div>
</div>
<hr>
<div class="row">
  <div class="col-md-4 mb-2 text-center p-2">
    <p>
      <i class="fa fa-book"></i>
      <span class="h1">
        {{\App\Program::count()}} 
      </span>
     
      Program(s)
    </p>
  </div>
  <div class="col-md-4 mb-2 text-center p-2">
    <p>
      <i class="fa fa-users"></i>
      <span class="h1">
        {{\App\Student::count()}} 
      </span>
      Student(s)
    </p>
  </div>
  <div class="col-md-4 mb-2 text-center p-2">
    <p>
      <i class="fa fa-poll"></i>
      <span class="h1">
        {{\App\Grade::count()}} 
      </span>
      Grade(s)
    </p>
  </div>
</div>
@php
    $df = round(disk_free_space("/") / 1024 / 1024 / 1024);
    $dt = round(disk_total_space("/") / 1024 / 1024 / 1024);
    $du = $dt - $df;
    $useSpace = $du/$dt;
@endphp
<div class="row justify-content-center">
  <div class="col-md-12 mb-2">
    <div class="card">
      <div class="card-header">
        <i class="fa fa-hdd"></i> Storage 
      </div>
      <div class="card-body">
        <span class='mr-2'>
          <strong>Total space : </strong> {{$dt}} GB
        </span>
        <span class='mr-2'>
          <strong>Used space : </strong> {{$du}} GB
        </span>
        <span class='mr-2'>
          <strong>Free space : </strong> {{$df}} GB
        </span>
        <div class="progress">
            <div class="progress-bar bg-primary" style="width:{{$useSpace}}%">
                {{$du}} GB
            </div>
          </div>
      </div>
    </div>
  </div>
</div>

<blockquote class="quote-card ">
  @php
      $sayin = explode('-',\App\Proverb::inRandomOrder()->first()->message)
  @endphp
  <p>
   {{$sayin[0]}}
 </p>

 <cite>
   {{$sayin[1]}}

</cite>
</blockquote>
@else
<div class="d-flex justify-content-center">
  <img src="/img/avatar.png" alt="" class="img-fluid rounded-circle p-1" style="width:100px;height:100px;border:2px solid #ddd">
</div>
<div class="row">
  <div class="col-md-12 text-center">
    <h2>
      {{auth()->user()->student->fullname()}}
    </h2>
    <p>
      {{auth()->user()->student->program->name}} - {{auth()->user()->student->program->description}}
    </p>
  </div>
</div>
@php
    $semesters = ['FIRST','SECOND','SUMMER'];
    $year = ['FIRST','SECOND','THIRD','FOURTH'];
@endphp
<div class="row justify-content-center">
  <div class="col-md-8">
    @for ($i = 0; $i < auth()->user()->student->program->term; $i++)
    <details class="mb-1">
      <summary class="bg-primary p-2 text-white">{{strtolower($year[$i])}} Year</summary>
        @foreach ($semesters as $sem)
        <details  class="">
          <summary style="text-transform: capitalize" class="bg-secondary text-white pl-5 py-2" >
            {{strtolower($sem)}} Semester
          </summary>
          <table class="table-bordered d-print-table w-100">
            <tr>
              <th>
                Date
              </th>
              <th>
                Subject Code
              </th>
              <th>
                Subject Description
              </th>
              <th>
                Unit
              </th>
              <th>
                Mark
              </th>
            </tr>
            @foreach (auth()->user()->student->getGrades($year[$i],$sem) as $item)
          <tr class="{{$item->grade >= 4.00 || $item->grade  == 'INC' ? 'bg-danger text-white':''}}">
                  <td>
                    {{$item->created_at->format('M-d-Y')}}
                  </td>
                  <td>
                    {{$item->code}}
                  </td>
                  <td>
                    {{$item->description}}
                  </td>
                  <td>
                    {{$item->unit}}
                  </td>
                  <td>
                    {{$item->grade}}
                  </td>
                </tr>
            @endforeach
          </table>
        </details>
        @endforeach
    </details>
    @endfor
  </div>
</div>
@endcan
@endsection
