<h2>Pre order car</h2>
<form name="carorder" id="carorder" action="javascript:void(0);">
    <div class="form-group ">
        <input type="hidden" name="id" id="id" value='<?php echo $_POST['id']; ?>'/>

        <div class="input-group">
            <span class="input-group-addon">
                Name
            </span>
            <input type="text" class="form-control"
                               name="name" id="name" value="" placeholder="Enter your Name" />
        </div>

        <div class="input-group">
            <span class="input-group-addon">
                Surname
            </span>
            <input type="text" class="form-control"
                               name="surname" id="surname" value="" placeholder="Enter your Surname" />
        </div>

        <div class="input-group">
            <span class="input-group-addon">
                Select type pay
            </span>
            <select class="form-control" name="paytype" id="paytype">
                <option value="credit card">Credit card</option>
                <option value="cash">Cash</option>
            </select>
        </div>

        <button type="submit" class="btn btn-warning"
                              onclick="order()">Order</button>
    </div>
</form>
