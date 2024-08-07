@extends('user.layout.master')
@section('title', 'Generated Question')
@section('content')
    @php
        $m = 'generatedQues';
        $sm = '';
        $ssm = '';
    @endphp

    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">
                    <ul class="breadcrumbs">
                        <li class="nav-home"><a href="{{ route('user.dashboard') }}"><i class="flaticon-home"></i></a></li>
                        <li class="separator"><i class="flaticon-right-arrow"></i></li>
                        <li class="nav-item">Question</li>
                    </ul>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <style>
                                .quesType {
                                    font-size: 18px;
                                    border-bottom: 1px solid gray;
                                    margin-bottom: 10px !important;
                                }

                                .questionArea {
                                    padding: 0 20px;
                                }

                                .option {
                                    margin-left: 30px;
                                }

                                .form-check [type=checkbox]:checked,
                                .form-check [type=checkbox]:not(:checked) {
                                    position: absolute;
                                    left: 0;
                                }

                                .form-check,
                                .form-group {
                                    margin-bottom: 0;
                                    padding: 0px;
                                }
                            </style>
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h4 class="card-title"></h4>
                                    <button type="button" class="btn btn-success btn-sm ml-auto" id="p"
                                        onClick="printDiv('printableArea')"><i class="fas fa-print"></i> Print</button>
                                </div>
                            </div>
                            <form action="">
                                <div class="card-body" id="printableArea">
                                    @include('include.question_paper_head')
                                    @php $x = 1 @endphp
                                    @if ($questionPapers->where('type', 'multiple_choice')->count() > 0)
                                        <h4 class="quesType">multiple_choice</h4>
                                        @foreach ($questionPapers->where('type', 'multiple_choice') as $key => $question)
                                            <div class="questionArea">
                                                <h4 class="question">{{ $x++ }}. {{ $question->question->ques }}
                                                    <span style="float:right">{{ $question->question->mark }}</span>
                                                </h4>
                                                @foreach ($question->question->options as $option)
                                                    <div class="col-md-6 option">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="{{ $option->id }}"
                                                                id="exampleRadios{{ $option->id }}">
                                                            <label class="form-check-label"
                                                                for="exampleRadios{{ $option->id }}"
                                                                id="exampleRadios{{ $option->id }}">
                                                                {{ $option->option }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endforeach
                                        <br>
                                        <br>
                                    @endif

                                    @if ($questionPapers->where('type', 'short_question')->count() > 0)
                                        <h4 class="quesType">short_question</h4>
                                        @foreach ($questionPapers->where('type', 'short_question') as $question)
                                            <div class="questionArea">
                                                <h4 class="question">{{ $x++ }}. {{ $question->question->ques }}
                                                    <span style="float:right">{{ $question->question->mark }}</span>
                                                </h4>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <textarea name="" id="" cols="20" rows="8" class="form-control"></textarea>
                                                </div>
                                            </div>
                                        @endforeach
                                        <br>
                                        <br>
                                    @endif

                                    @if ($questionPapers->where('type', 'long_question')->count() > 0)
                                        <h4 class="quesType">long_question</h4>
                                        @foreach ($questionPapers->where('type', 'long_question') as $question)
                                            <div class="questionArea">
                                                <h4 class="question">{{ $x++ }}. {{ $question->ques }}
                                                    <span style="float:right">{{ $question->mark }}</span>
                                                </h4>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <textarea name="" id="" cols="20" rows="10" class="form-control"></textarea>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                {{-- <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <style>
                            .quesType{
                                font-size: 18px;
                                border-bottom: 1px solid gray;
                                margin-bottom: 10px !important;
                            }
                            .questionArea {
                                padding: 0 20px;
                            }
                            .option{
                                margin-left: 30px;
                            }
                            .form-check [type=checkbox]:checked, .form-check [type=checkbox]:not(:checked) {
                                position: absolute;
                                left: 0;
                            }
                        </style>
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title"></h4>
                            </div>
                        </div>
                        <form action="{{ route('user.generated_question.store') }}" method="post">
                            @csrf

                            <div class="card-body" id="printableArea">
                                <div class="text-center">
                                    <h2>Bangladesh Navy</h2>
                                    <p>{{ $questions->first()->exam->name }} Exam Question Paper-{{ Carbon\Carbon::parse($questions->first()->exam->date)->format('Y') }}</p>
                                    <p>{{ $questions->first()->question->subject->name }}</p>
                                </div>
                                <h4 class="quesType">multiple_choice</h4>
                                @php $x = 1; @endphp
                                @foreach ($questions->where('type', 'multiple_choice') as $key => $question)
                                <input type="hidden" name="exam_id" value="{{ $question->exam_id }}">
                                <input type="hidden" name="question_id[]" value="{{ $question->id }}">
                                <div class="questionArea">
                                    <h4 class="question">{{$x++}}. {{ $question->ques }}
                                        <span style="float:right">{{ $question->mark }}</span>
                                    </h4>
                                    @foreach ($question->options as $option)
                                    <div class="col-md-6 option">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="ans[]" value="{{$option->option}}" id="exampleRadios{{$option->id}}">
                                            <label class="form-check-label" for="exampleRadios{{$option->id}}" id="exampleRadios{{$option->id}}">
                                                {{ $option->option }}
                                            </label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @endforeach
                                <br>
                                <br>
                                <h4 class="quesType">short_question</h4>
                                @foreach ($questions->where('type', 'short_question') as $question)
                                <input type="hidden" name="question_id[]" value="{{ $question->id }}">
                                <input type="hidden" name="ans[]" value="{{ $question->ques }}">
                                <div class="questionArea">
                                    <h4 class="question">{{$x++}}. {{ $question->ques }}
                                        <span style="float:right">{{ $question->mark }}</span>
                                    </h4>
                                    <textarea name="question[]" rows="5" class="form-control"></textarea>
                                </div>
                                @endforeach
                                <br>
                                <br>
                                <h4 class="quesType">long_question</h4>
                                @foreach ($questions->where('type', 'long_question') as $question)
                                <input type="hidden" name="question_id[]" value="{{ $question->id }}">
                                <input type="hidden" name="ans[]" value="{{ $question->ques }}">
                                <div class="questionArea">
                                    <h4 class="question">{{$x++}}. {{ $question->ques }}
                                        <span style="float:right">{{ $question->mark }}</span>
                                    </h4>
                                    <textarea name="question[]" rows="8" class="form-control"></textarea>
                                </div>
                                @endforeach
                            </div>
                            <div class="text-center card-action">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> --}}
            </div>
        </div>
        @include('include.footer')
    </div>

    @push('custom_scripts')
        <!-- Datatables -->
        @include('include.data_table')

        <script>
            function printDiv(divName) {
                $("#footer_signature_area").show();
                $("div").removeClass("dataTables_length, table-responsive");
                var printContents = document.getElementById(divName).innerHTML;
                var originalContents = document.body.innerHTML;
                document.body.innerHTML = printContents;
                $("body, table thead tr th, table thead, table tr th, table tbody tr th, table tbody tr td, table tfoot tr td")
                    .css("color", "black");
                // $("table thead tr th, table thead, table tr th").css("background", "red");
                // $("table, table tr").css("border","1px solid gray");
                $(".no-print, .dataTables_filter, #multi-filter-select_length, #multi-filter-select_info, #multi-filter-select_paginate")
                    .css("display", "none");
                window.print();
                document.body.innerHTML = originalContents;
            }
        </script>
    @endpush
@endsection
