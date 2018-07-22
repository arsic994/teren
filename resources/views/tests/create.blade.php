@extends('layouts.app')

@section('countdown')

<script type="text/javascript">
    // set minutes
    var mins = {{$quiz_duration}};

    // calculate the seconds 
    var secs = mins * 60 - 1;
    function countdown() 
    {
        setTimeout('Decrement()',1000);
    }

    function Decrement() 
    {
        if(secs > 0){   
            if (document.getElementById) {
                minutes = document.getElementById("minutes");
                seconds = document.getElementById("seconds");
                // if less than a minute remaining
                if (seconds < 59) {
                    seconds.value = secs;
                } else {
                    minutes.value = getminutes();
                    seconds.value = getseconds();
                }
                secs--;
                setTimeout('Decrement()',1000);
            }
        }else{
            document.getElementById('form').submit();
        }
    }

    function getminutes() 
    {
        // minutes is seconds divided by 60, rounded down
        mins = Math.floor(secs / 60);
        return mins;
    }

    function getseconds() 
    {
        // take mins remaining (as seconds) away from total seconds remaining
        return secs-Math.round(mins *60);
    }
</script>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div id="timer">
             <center><h2>Преостало време до краја квиза:</h2></center>
             <center><input id="minutes" type="text" style="width: 50px; border: none; background-color:none; font-size: 30px; font-weight: bold;">
                :
                <input id="seconds" type="text" style="width: 50px; border: none; background-color:none; font-size: 30px; font-weight: bold;">
            </div></center>
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Kвиз</h3></div>
                <div class="panel-body">
                    <form id="form" class="form-horizontal" method="POST" action="{{ route('tests.store') }}">
                        {{ csrf_field() }}
                        @if(count($questions) > 0)
                        <?php $i = 1; ?>
                        @foreach($questions as $question)
                        @if ($i > 1) <hr /> @endif
                        <div>
                            <strong>Питање {{ $i }}.<br />{!! nl2br($question->question_text) !!}</strong>
                            <input type="hidden" name="questions[{{ $i }}]" value="{{ $question->id }}">
                            @foreach($question->options as $option)
                            <br>
                            <label class="radio-inline">
                                <input type="radio" name="answers[{{ $question->id }}]" value="{{ $option->id }}">{{ $option->option }}
                            </label>
                            @endforeach   
                        </div>
                        <?php $i++; ?>
                        @endforeach
                        @endif
                        <script>
                            countdown();
                        </script>
                        {{--{!! $questions->render() !!}--}}
                        <input type="hidden" name="number_of_questions" value="{{ $number_of_questions }}">
                        <input type="hidden" name="test_id" value="{{$test_id}}">
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Сачувај
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
