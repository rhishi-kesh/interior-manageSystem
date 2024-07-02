@extends('layout/studentIndex')
@section('content')
    <div class="animate__animated p-6 bg-gray-200 dark:bg-gray-950" :class="[$store.app.animation]">
        <div class="bg-white dark:bg-slate-900 shadow-md rounded px-4 md:px-8 pt-6 pb-8 mb-4 w-full">
            <h2 class="mb-2 font-bold text-3xl dark:text-white text-blue-500">My Course</h2>
            <hr>
            <div class="grid grid-cols-1 lg:grid-cols-3 mt-4">
                @foreach ($student->courses as $item)
                    <a href="" class="block p-5">
                        <div class="shadow-lg rounded-md border">
                            <img src="{{ asset('storage/' . $item->thumbnail) }}" alt="" class="w-full rounded-t-md">
                            <div class="p-5 pb-2">
                                <h5 class="text-3xl font-semibold">
                                    {{ $item->name }}
                                </h5>
                            </div>
                            <div class="p-4">
                                @php
                                    $classTaken = count($item->attendance->where('course_id', $item->id)->groupBy('date'));
                                    $totalClass = $item->certificate_criteria->lecture;
                                    $completedClsss = ($classTaken * 100) / $totalClass;
                                @endphp
                                <div class="w-full h-[20px] bg-gray-200 rounded-full dark:bg-gray-700 relative">
                                    <div class="{{ $completedClsss == 0 ? '' : 'bg-blue-500' }} rounded-full h-full text-xs font-medium {{ $completedClsss < 50 ? 'text-blue-500' : 'text-white' }} text-center p-0.5 leading-none rounded-full" style="width: {{ $completedClsss < 100 ? $completedClsss . '%' : '100%' }}">
                                        <span class="absolute left-0 top-0 w-full h-full flex justify-center items-center">{{ ($completedClsss >= 1) ? number_format($completedClsss, 0) : number_format($completedClsss, 2) }}%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
