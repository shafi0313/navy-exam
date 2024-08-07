@extends('admin.layout.master')
@section('title', 'Generate Question')
@section('content')
    @php
        $m = 'generateQuestion';
        $sm = '';
        $ssm = '';
        $delete = 'delete';
        $edit = 'edit';
    @endphp

    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">
                    <ul class="breadcrumbs">
                        <li class="nav-home"><a href="{{ route('admin.dashboard') }}"><i class="flaticon-home"></i></a></li>
                        <li class="separator"><i class="flaticon-right-arrow"></i></li>
                        <li class="nav-home"><a href="{{ route('admin.generate_question.index') }}">Generate Question</a>
                        </li>
                        <li class="separator"><i class="flaticon-right-arrow"></i></li>
                        <li class="nav-item">Question</li>
                    </ul>
                </div>
                <form action="{{ route('admin.generate_question.addQues') }}" method="POST">
                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="subject_id">Subject <span class="t_r">*</span></label>
                                                <select class="form-control select2" name="subject_id" id="subject_id">
                                                    <option selected value disabled>Select..</option>
                                                    @foreach ($subjects as $subject)
                                                        <option value="{{ $subject->id }}">{{ $subject->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('subject_id'))
                                                    <div class="alert alert-danger">{{ $errors->first('subject_id') }}</div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="type">Question Type <span class="t_r">*</span></label>
                                                <select class="form-control select2 type" name="type" id="ques_type"
                                                    required>
                                                    <option selected value disabled>Select</option>
                                                    <option value="multiple_choice">Multiple Choice</option>
                                                    <option value="short_question">Short Question</option>
                                                    <option value="long_question">Long Question</option>
                                                </select>
                                                @if ($errors->has('type'))
                                                    <div class="alert alert-danger">{{ $errors->first('type') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <h3 class="text-primary">Question</h3>
                                        <table class="table table-striped table-bordered table-hover w-100">
                                            <thead>
                                                <tr>
                                                    <th>Question</th>
                                                    <th>Type</th>
                                                    <th>Marks</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="questionArea" id="questionArea"></tbody>
                                            <tbody class="questionArea" id="question"></tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-12 text-center card-action">
                                        <button type="submit" class="btn btn-primary">Add</button>
                                        <button type="reset" class="btn btn-danger">Cancel</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title"></h4>
                            <a href="{{ route('admin.generated_question.show', [$questionInfo->id, $questionSubjectInfos->first()->set, 'pdf']) }}"
                                class="btn btn-success ml-auto" id="p" style="width: 250px" target="_blank"><i
                                    class="fas fa-print"></i> PDF Download</a>
                        </div>
                    </div>
                    {{-- <form action="{{ route('admin.generate_question.complete') }}" method="POST">
                    @csrf
                    <input type="hidden" name="quesInfoId" value="{{ $questionInfoId }}"> --}}
                    @include('include.question_paper')
                    {{-- <div class="col-md-12 text-center card-action">
                        <button type="submit" class="btn btn-primary">Generate Question</button>
                    </div>
                </form> --}}
                </form>
            </div>
        </div>
        @include('include.footer')
    </div>
    <style>
        .ptag p {
            display: inline-block;
        }
    </style>
    @push('custom_scripts')
        <!-- Datatables -->
        @include('include.data_table')
        <script>
            $('#ques_type').change(function() {
                $("#questionArea").html('');
                let subject_id = $('#subject_id').find(":selected").val();
                const get_question_id = $("input[name='get_question_id[]']").map(function() {
                    return $(this).val(); // Extract each input value
                }).get();
                let quesId = [];
                $("input[name='question_id']").each(function() {
                    quesId.push(this.value);
                });
                let ques_type = $('#ques_type').find(":selected").val();
                $.ajax({
                    url: "{{ route('admin.generate_question.getQuestion') }}",
                    data: {
                        subject_id: subject_id,
                        ques_type: ques_type,
                        get_question_id: get_question_id,
                    },
                    method: 'get',
                    success: res => {
                        if (res.status == 200) {
                            let quesData = '';
                            $.each(res.questions, function(i, v) {
                                let str = v.type;
                                let id = v.id;
                                let url = '{{ route('admin.question.edit', ':id') }}';
                                url = url.replace(':id', id);
                                quesData += '<tr>'
                                quesData +=
                                    '<td class="ptag"><input type="checkbox" name="question_id[]" value="' +
                                    v.id + '">&nbsp;&nbsp; ' + v.ques + '</td>'
                                quesData += '<td>' + str.replace(/_/g, ' ') + '</td>'
                                quesData += '<td>' + v.mark + '</td>'
                                quesData += '<td>'
                                quesData += '<div class="form-button-action">'
                                quesData += '<a href=' + url +
                                    ' data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task">Edit</a>'
                                quesData += '</div>'
                                quesData += '</td>'
                                quesData += '</tr>'
                            });
                            // if(quesData==''){
                            //     alert('fd')
                            // }
                            $("#questionArea").append(quesData);
                        } else {
                            alert('No question found')
                        }
                    },
                    error: err => {
                        alert('No question found')
                    }
                });
            });
        </script>
    @endpush
@endsection
