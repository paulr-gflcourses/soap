<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">

        <title><?php echo TITLE ?></title>
        <link href="html/css/bootstrap.min.css" rel="stylesheet">
        <link href="html/css/my.css" rel="stylesheet">

    </head>
    <body>

        <div class="container">
            <h1>Car Service</h1>

            <form action="javascript:void(0);">
                <div class="form-group ">
                    <button type="submit" class="btn btn-success"
                                          onclick="getCarList()">Get Cars list</button>
                </div>
                <div class="form-group row">
                    <div class="col-lg-4">
                        <h3>Filter options</h3>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <input type="checkbox" name="filter" value="model"/>
                                Model
                            </span>
                            <select class="form-control" id="model">
                                <option value="">-----Select model</option>
                                <option>BMW</option>
                                <option>Chevrolet</option>
                                <option>Nissan</option>
                            </select>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon col">
                                <input type="checkbox" name="filter" value="year"/>
                                Year
                            </span>
                            <input type="number" class="form-control"
                            name="year" id="year" value="" />
                            <span class="input-group-addon">year</span>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <input type="checkbox" name="filter"
                                value="engine"/>
                                Engine
                            </span>
                            <input type="number" class="form-control"
                            name="engine" id="engine" value="" />
                            <span class="input-group-addon">L</span>
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon">
                                <input type="checkbox" name="filter"
                                value="color"/>
                                Color
                            </span>
                            <select class="form-control" id="color">
                                <option value="">-----Select color</option>
                                <option>black</option>
                                <option>red</option>
                                <option>metallic</option>
                            </select>
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon">
                                <input type="checkbox" name="filter"
                                value="maxspeed"/>
                                Max speed
                            </span>
                            <input type="number" class="form-control col-lg-3"
                            name="maxspeed" id="maxspeed" value="" />
                            <span class="input-group-addon">km/h</span>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <input type="checkbox" name="filter"
                                value="price"/>
                                Price
                            </span>
                            <input type="number" class="form-control col-lg-3"
                            name="price" id="price" value="" />
                            <span class="input-group-addon">$</span>
                        </div>
                    </div>
                </div>
            </form>

            <div class="results" id="results">
                <table class="table" id="table">

                </table>
            </div>

        </div>

        <script src="html/js/script.js"></script>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="html/js/bootstrap.min.js"></script>


    </body>
</html>
