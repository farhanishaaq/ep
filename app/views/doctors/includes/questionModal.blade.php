
<div class="container">

  <!-- Trigger the modal with a button -->

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <form  id="search_form"   method="post" action="{{route('question.store')}}">                                                                    {{--Header--}}
        <div class="modal-header" style=" background-color: #d3d3d3">
          <button type="button" data-dismiss="modal" style="float: right;">&times;</button>
          <h4 class="modal-title" style="float: left;">Ask a Question</h4>
        </div>
                                                                                    {{--Body--}}
        <div class="modal-body">
                                                                                {{--Form Start Here--}}
                {{ Form::token() }}

                <div class="form-group">
                    <textarea  class="form-control" placeholder="Ask question here" maxlength="280" name="question" id="question" rows="6"></textarea>

                </div>

                <input class="form-control" type="hidden" value="{{$id}}" name="doctor_id" id="Doctro_id">

                <div class="modal-footer">
                    {{--<input type="submit" class="btn btn-raised btn-sm btn-1">--}}
            <button class="btn btn-raised btn-sm btn-1" onclick="form_submit()">Submit</button>
                </div>

        </div>
            </form>

        </div>
      </div>
    </div>
  </div>
<script type="text/javascript">
    function form_submit() {
        document.getElementById("search_form").submit();
    }
</script>