

<div class="container">


    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header" style=" background-color: #d3d3d3">
                    <button type="button" data-dismiss="modal" style="float: right;">Cancel it</button>
                    <h4 class="modal-title" style="float: left;">Ask a Question</h4>
                </div>

                <div class="modal-body">

                    <form  id="new_question" action=""  method="post">
                        <div class="form-group">
            <textarea onkeyup="" class="form-control" placeholder="Ask question here" maxlength="280" name="question[question_details]" id="question_question_details" rows="6">
        </textarea>

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

