<h3 class="mT10 mB0 c3">Medicine View</h3>
        <hr class="w95p fL mT0" />
        <p class="col-xs-12 fL taR"></p>
        <section class="form-Section col-md-12 h400 fL">
            {{--Medicine Info--}}
            <div class="container w100p">
                <h3 class="mT15 mB0 c3">Medicine Info</h3>
                <hr class="w95p fL mT0" />
                <hr class="w95p fL mT0" />


                <div class="form-group col-xs-12">
                    <label class="col-xs-5 control-label asterisk">Medicine Name:*</label>
                    <div class="col-xs-4">
                        <input type="text" id="medicine_name" name="name"  value="{{{ Form::getValueAttribute('name', null) }}}" class="form-control" placeholder="Medicine Name" required="required">
                        <span id="error_refill" class="field-validation-msg"></span>
                    </div>
                </div>

                <div class="form-group col-xs-12">
                    <label class="col-xs-5 control-label asterisk">Description:</label>
                    <div class="col-xs-4">
                        <textarea type="text" id="description" name="description" rows="2" cols="20" class="form-control" placeholder="Description">{{{ Form::getValueAttribute('description', null) }}}</textarea>
                        <span id="errorName" class="field-validation-msg"></span>
                    </div>
                </div>
            </div>

        </section>

        <div class="col-xs-12 taR pR0 mT20">
            <input type="button" id="cancel" value="Go Back" onclick="goTo('{{URL::previous()}}')" />
        </div>
