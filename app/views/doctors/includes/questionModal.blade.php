
<div class="container">
  <h2>Large Modal</h2>
  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Large Modal</button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
                                                                                 {{--Header--}}
        <div class="modal-header" style=" background-color: #d3d3d3">
          <button type="button" data-dismiss="modal" style="float: right;">&times;</button>
          <h4 class="modal-title" style="float: left;">Ask a Question</h4>
        </div>
                                                                                    {{--Body--}}
        <div class="modal-body">
                                                                                {{--Form Start Here--}}
        <form  id="new_question" action=""  method="post">
          <div class="form-group">
            <textarea onkeyup="textCounter(this,&#39;counter&#39;,280);" class="form-control" placeholder="Ask question here" maxlength="280" name="question[question_details]" id="question_question_details" rows="6">
        </textarea>
            <div style="float: right;">
            Character Left:<input disabled  maxlength="3" size="3" value="280" id="counter" style="border: none;font-size: 15px;">
            </div>
          </div>
          </form>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-raised btn-sm btn-1" data-toggle="modal" data-target="#myModal"><strong>Submit</strong></button>
        </div>


      </div>
    </div>
  </div>
</div>
